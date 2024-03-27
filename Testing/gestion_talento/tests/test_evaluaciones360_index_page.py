import pytest
from pages.evaluaciones360_index_page import Evaluaciones_360_log_in_modulo

#Usuario y Contraseña

username = "cesar.escobar@silent4business.com"
password = "password"     

@pytest.mark.usefixtures("browser")
def test_evaluaciones360_manualmente(browser):
    
    evaluaciones360_log_in = Evaluaciones_360_log_in_modulo(browser)
    evaluaciones360_log_in.login(username, password)
    evaluaciones360_log_in.in_modulos()

    

