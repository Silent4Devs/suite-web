import pytest
from pages.evaluaciones360_create_page import Evaluaciones_360_create_page

#Usuario y Contraseña

username = "admin@admin.com"
password = "#S3cur3P4$$w0Rd!"   

input_chip_xpath = "//li[contains(@class,'select2-search select2-search--inline')]"
opcion_deseada_1 = "Cesar Ernesto Escobar Hernández"  


@pytest.mark.usefixtures("browser")
def test_evaluaciones360_manualmente(browser):
    
    evaluaciones360_create = Evaluaciones_360_create_page(browser)
    evaluaciones360_create.login(username, password)
    evaluaciones360_create.in_modulos()
    evaluaciones360_create.create_configuracion()
    evaluaciones360_create.select_publico_objetivo()
    evaluaciones360_create.select_empleado_evaluar_1(input_chip_xpath, opcion_deseada_1)
    evaluaciones360_create.create_evaluadores()


    

