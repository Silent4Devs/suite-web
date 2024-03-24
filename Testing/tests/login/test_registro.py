'''import pytest
from pages.login_page import LoginPage
from pages.incorrect_login_page import IncorrectLoginPage
from pages.fg_password_login import FgPasswordLogin
from pages.registro_visitantes_login import RegistroVisitantesLogin

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

@pytest.mark.usefixtures("browser")
def test_fg_password_login(browser):
    email_fg = "zaid.garcia@becarios.silent4business.com"
    fg_password_login= FgPasswordLogin(browser)
    fg_password_login.fg_password_login(email_fg)

@pytest.mark.usefixtures("browser")
def test_registro_visitantes_login(browser):
    nombre = "Tester User"
    apellido = "Tester User"
    correo = "zaid.garcia@becarios.silent4business.com"
    telefono = "+525610435996"
    disp_electronico = "Computadora Portatil"
    marca = "Apple"
    serie = "lorempisum 123 456 789 000 000 000  "
    motivo = "Prueba de registro de visitantes"
    registro_visitantes_login = RegistroVisitantesLogin(browser)
    registro_visitantes_login.registro_visitantes_login(nombre, apellido, correo, telefono, disp_electronico, marca, serie, motivo)
'''
