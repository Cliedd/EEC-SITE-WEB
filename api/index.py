"""
Point d'entrée Vercel — test minimal d'abord, puis import du backend complet.
"""
import sys
import os

# FastAPI minimal de test (avant import backend)
from fastapi import FastAPI, Request
from fastapi.responses import JSONResponse

# Ajouter backend/ au path Python
backend_path = os.path.join(os.path.dirname(os.path.abspath(__file__)), "..", "backend")
sys.path.insert(0, os.path.abspath(backend_path))

# Import PyMySQL en premier pour remplacer MySQLdb
try:
    import pymysql
    pymysql.install_as_MySQLdb()
    _pymysql_ok = True
except Exception as e:
    _pymysql_ok = str(e)

# Import de l'app FastAPI principale
try:
    from app.main import app
    _import_ok = True
    _import_error = None
except Exception as e:
    import traceback
    _import_ok = False
    _import_error = traceback.format_exc()

    # App de fallback si import échoue
    app = FastAPI()

    @app.api_route("/{path:path}", methods=["GET", "POST", "PUT", "DELETE", "PATCH", "OPTIONS"])
    async def fallback(path: str, request: Request):
        return JSONResponse(status_code=500, content={
            "error": "Backend import failed",
            "pymysql_ok": _pymysql_ok,
            "import_error": _import_error,
            "backend_path": backend_path,
            "backend_path_exists": os.path.exists(backend_path),
            "sys_path": sys.path[:5],
            "url_path": str(request.url.path),
        })
