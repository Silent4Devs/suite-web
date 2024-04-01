import pytest
from pages.gestion_talento.edit.evaluaciones360_edit_page import Evaluaciones_360_edit_page

#Usuario y Contraseña

username = "cesar.escobar@silent4business.com"
password = "password"   

@pytest.mark.usefixtures("browser")
def test_evaluaciones360_manualmente(browser):
    
    evaluaciones360_create = Evaluaciones_360_edit_page(browser)
    evaluaciones360_create.login(username, password)
    evaluaciones360_create.in_modulos()
    evaluaciones360_create.edit_evaluacion360()
    evaluaciones360_create.send_reminder()
    evaluaciones360_create.view_evaluacion360()



    

