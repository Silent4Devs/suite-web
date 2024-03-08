import pytest
from pages.capacitaciones_page import CapacitacionesPage

#CREDENCIALES LOGIN
username = "admin@admin.com"
password = "#S3cur3P4$$w0Rd!"

#FUNCIONES DE PRUEBA
@pytest.mark.usefixtures("browser")
def test_capacitaciones(browser):

    capacitaciones_page = CapacitacionesPage(browser)
    capacitaciones_page.login(username, password)

    capacitaciones_page.open_menu()

    capacitaciones_page.go_to_capacitaciones()
    capacitaciones_page.mis_cursos()

    capacitaciones_page.primer_filtro()
    capacitaciones_page.segundo_filtro()
    capacitaciones_page.tercer_filtro()


