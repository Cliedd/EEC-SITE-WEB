import sys
import os

# Add backend directory to Python path
sys.path.insert(0, os.path.join(os.path.dirname(os.path.abspath(__file__)), "..", "backend"))

import pymysql
pymysql.install_as_MySQLdb()

from app.main import app  # noqa: F401 — Vercel ASGI entry point
