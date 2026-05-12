"""
Simple in-memory rate limiter (par IP).
Pour la production, utiliser Redis avec slowapi.
"""
import time
from collections import defaultdict
from fastapi import Request, HTTPException, status

# { ip: [(timestamp, endpoint), ...] }
_buckets: dict[str, list[float]] = defaultdict(list)

RATE_LIMITS = {
    "/api/auth/login":       (10, 60),   # 10 req / 60 s
    "/api/auth/admin/login": (5,  60),   # 5 req / 60 s
    "/api/auth/register":    (5,  300),  # 5 req / 5 min
    "/api/contacts":         (10, 300),  # 10 req / 5 min
    "/api/appointments":     (20, 300),  # 20 req / 5 min
}


def rate_limit_check(request: Request) -> None:
    path = request.url.path
    limit_cfg = RATE_LIMITS.get(path)
    if not limit_cfg or request.method not in ("POST",):
        return

    max_requests, window = limit_cfg
    ip = request.client.host if request.client else "unknown"
    key = f"{ip}:{path}"
    now = time.time()

    # Nettoyage des entrées expirées
    _buckets[key] = [t for t in _buckets[key] if now - t < window]

    if len(_buckets[key]) >= max_requests:
        raise HTTPException(
            status_code=status.HTTP_429_TOO_MANY_REQUESTS,
            detail="Trop de tentatives. Veuillez patienter avant de réessayer.",
        )

    _buckets[key].append(now)
