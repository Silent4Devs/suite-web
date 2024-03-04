import pytest
from pages.login_page import LoginPage
from pages.incorrect_login_page import IncorrectLoginPage

@pytest.mark.usefixtures("browser")
def test_login(browser):
    username = "admin@admin.com"
    password = "#S3cur3P4$$w0Rd!"
    login_page = LoginPage(browser)
    login_page.login(username, password)

@pytest.mark.usefixtures("browser")
def test_incorrect_login(browser):
    username = "usuario_incorrecto"
    password = "contraseña_incorrecta"
    incorrect_login_page = IncorrectLoginPage(browser)
    incorrect_login_page.login(username, password)
