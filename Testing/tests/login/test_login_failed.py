import pytest
from testing.pages.login.incorrect_login_page import IncorrectLoginPage


@pytest.mark.usefixtures("browser")
def test_login(browser):
    username = "prueba@prueba.com"
    password = "pruebaPassword"
    incorrect_login_page = IncorrectLoginPage(browser)
    incorrect_login_page.login(username, password)

