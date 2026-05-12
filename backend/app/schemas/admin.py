from datetime import datetime
from typing import Optional
from pydantic import BaseModel


class DashboardStats(BaseModel):
    total_visitors: int
    total_appointments: int
    pending_appointments: int
    total_accounts: int
    total_contacts: int
    unread_contacts: int


class VisitorOut(BaseModel):
    id_visitor: int
    name_surName: str
    email: str
    telephone: Optional[str]
    visitor_type: str
    source_page: Optional[str]
    ip_address: Optional[str]
    date_visit: datetime

    model_config = {"from_attributes": True}


class AuditLogOut(BaseModel):
    id_log: int
    user_id: Optional[int]
    user_email: Optional[str]
    action: str
    entity_type: Optional[str]
    status: str
    ip_address: Optional[str]
    timestamp: datetime

    model_config = {"from_attributes": True}
