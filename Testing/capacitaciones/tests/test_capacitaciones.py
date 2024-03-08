import pytest
from pages.capacitaciones_page import CapacitacionesPage

username = "admin@admin.com"
password = "#S3cur3P4$$w0Rd!"
tomar_curso_xpath = "//button[contains(.,'Tomar Curso')]"

@pytest.mark.usefixtures("browser")
def test_capacitaciones(browser):
    capacitaciones_page = CapacitacionesPage(browser)
    capacitaciones_page.login(username, password)
    capacitaciones_page.open_menu()
    capacitaciones_page.go_to_capacitaciones()
    capacitaciones_page.mis_cursos()
    capacitaciones_page.course_1()
    capacitaciones_page.siguiente_tema()

