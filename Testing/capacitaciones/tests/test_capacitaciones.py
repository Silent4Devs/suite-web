import pytest
from pages.capacitaciones_page import CapacitacionesPage

username = "admin@admin.com"
password = "#S3cur3P4$$w0Rd!"

@pytest.mark.usefixtures("browser")
def test_capacitaciones(browser):
    login_page = CapacitacionesPage(browser)
    login_page.login(username, password)
    login_page.open_menu()
    login_page.go_to_capacitaciones()
    login_page.mis_cursos()

