import pytest
from pages.gestion_contractual_page import GestionContractual

@pytest.mark.usefixtures("browser")
def test_gestion_contractual(browser):
    #LOGIN
    username = "admin@admin.com"
    password = "#S3cur3P4$$w0Rd!"
    login_page = GestionContractual(browser)
    login_page.login(username, password)
    #MENÚ HAMBURGUESA
    menu = GestionContractual(browser)
    menu.open_menu()
    #GESTIÓN CONTRACTUAL
    gestion_contractual_module = GestionContractual(browser)
    gestion_contractual_module.go_to_gestion_contractual()

