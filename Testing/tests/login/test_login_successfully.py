import pytest
from testing.pages.login.login_successfully import LoginPage


@pytest.mark.usefixtures("browser")
def test_login(browser):
    username = "zaid.garcia@becarios.silent4business.com"
    password = "Administrador2"
    login_successfully = LoginPage(browser)
    login_successfully.login(username, password)
