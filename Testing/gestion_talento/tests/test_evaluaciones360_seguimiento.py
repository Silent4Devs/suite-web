import pytest
from pages.evaluaciones360_seguimiento_page import Evaluaciones_360_seguimiento_page

username = "cesar.escobar@silent4business.com"
password = "password"

@pytest.mark.usefixtures("browser")
def test_evaluaciones360(browser):
    
    evaluaciones360_create = Evaluaciones_360_seguimiento_page(browser)
    evaluaciones360_create.login(username, password)
    evaluaciones360_create.in_modulos()

