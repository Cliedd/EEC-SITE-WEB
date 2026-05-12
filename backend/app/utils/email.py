import html as html_module
import aiosmtplib
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText
from ..config import settings


def _esc(value: str) -> str:
    """Échappe les caractères HTML pour éviter l'injection dans les emails."""
    return html_module.escape(str(value))


async def send_email(to: str, subject: str, html_body: str) -> bool:
    if not settings.SMTP_USER or not settings.SMTP_PASS:
        return False
    try:
        msg = MIMEMultipart("alternative")
        msg["Subject"] = subject
        msg["From"] = settings.SMTP_USER
        msg["To"] = to
        msg.attach(MIMEText(html_body, "html"))
        await aiosmtplib.send(
            msg,
            hostname=settings.SMTP_HOST,
            port=settings.SMTP_PORT,
            username=settings.SMTP_USER,
            password=settings.SMTP_PASS,
            start_tls=True,
        )
        return True
    except Exception:
        return False


async def send_appointment_confirmation(to: str, name: str, date: str, service: str) -> bool:
    body = f"""
    <div style="font-family:Arial,sans-serif;max-width:600px;margin:auto;padding:20px">
      <h2 style="color:#038a31">Centre Médical Protestant de Bafoussam</h2>
      <p>Bonjour <strong>{_esc(name)}</strong>,</p>
      <p>Votre demande de rendez-vous a bien été reçue.</p>
      <table style="border-collapse:collapse;width:100%;margin:20px 0">
        <tr><td style="padding:8px;border:1px solid #e0e0e0;background:#f9f9f9"><strong>Service</strong></td>
            <td style="padding:8px;border:1px solid #e0e0e0">{_esc(service)}</td></tr>
        <tr><td style="padding:8px;border:1px solid #e0e0e0;background:#f9f9f9"><strong>Date souhaitée</strong></td>
            <td style="padding:8px;border:1px solid #e0e0e0">{_esc(date)}</td></tr>
      </table>
      <p>Notre équipe vous contactera pour confirmer votre rendez-vous.</p>
      <p style="color:#666;font-size:0.9em">Centre Médical Protestant de Bafoussam — 24h/24, 7j/7</p>
    </div>
    """
    return await send_email(to, "Confirmation de demande de rendez-vous — CMPB", body)


async def send_contact_ack(to: str, name: str) -> bool:
    body = f"""
    <div style="font-family:Arial,sans-serif;max-width:600px;margin:auto;padding:20px">
      <h2 style="color:#038a31">Centre Médical Protestant de Bafoussam</h2>
      <p>Bonjour <strong>{_esc(name)}</strong>,</p>
      <p>Nous avons bien reçu votre message et vous répondrons dans les plus brefs délais.</p>
      <p style="color:#666;font-size:0.9em">Centre Médical Protestant de Bafoussam — cmpbafoussam2020@gmail.com</p>
    </div>
    """
    return await send_email(to, "Message reçu — CMPB", body)
