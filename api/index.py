"""
Test minimal SANS import backend — pour isoler le problème Vercel routing.
Si cet endpoint répond correctement, le problème est dans l'import backend.
"""
from fastapi import FastAPI, Request

app = FastAPI()


@app.api_route("/{path:path}", methods=["GET", "POST", "PUT", "DELETE", "PATCH", "OPTIONS", "HEAD"])
async def catch_all(path: str, request: Request):
    return {
        "vercel_routing_ok": True,
        "url_path": str(request.url.path),
        "path_param": path,
        "method": request.method,
    }
