import pytest
from pages.login.reset_password.fg_password_login import FgPasswordLogin

def test_reset_password(browser):
    # Inicializar la página de recuperación de contraseña
    fg_password_login = FgPasswordLogin(browser)
    fg_password_login.fg_password_login()
    # Ingresar el correo electrónico
    email_fg = "zaid.garcia@becarios.silent4business.com"
    fg_password_login.email_input(email_fg)
    #Submit
    fg_password_login.submit_button()
