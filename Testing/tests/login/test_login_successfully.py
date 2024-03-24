import pytest
from testing.pages.login.login_successfully import LoginPage


@pytest.mark.usefixtures("browser")
def test_login(browser):
    username = "admin@admin.com"
    password = "#S3cur3P4$$w0Rd!"
    login_page = LoginPage(browser)
    login_page.login(username, password)
