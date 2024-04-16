import pytest
from pages.login.registro.registro_visitantes_login import RegistroVisitantesLogin

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

