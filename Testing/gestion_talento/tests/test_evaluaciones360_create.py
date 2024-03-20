import pytest
from pages.evaluaciones360_create_page import Evaluaciones_360_create_page

#Usuario y Contraseña

username = "cesar.escobar@silent4business.com"
password = "password"   

input_chip_xpath = "//li[contains(@class,'select2-search select2-search--inline')]"
input_chip_xpath_2 = "//li[contains(@class,'select2-search select2-search--inline')]"
opcion_deseada_1 = "Cesar Ernesto Escobar Hernández"  
opcion_deseada_2 = "Marti David Tendilla Gonzalez"
opciones_deseadas = ["", "Cesar Ernesto Escobar Hernández", "Marti David Tendilla Gonzalez"]

fecha_deseada = "14/05/2024"

@pytest.mark.usefixtures("browser")
def test_evaluaciones360_manualmente(browser):
    
    evaluaciones360_create = Evaluaciones_360_create_page(browser)
    evaluaciones360_create.login(username, password)
    evaluaciones360_create.in_modulos()
    evaluaciones360_create.create_configuracion()
    evaluaciones360_create.create_grupo()
    evaluaciones360_create.select_publico_objetivo()
    #evaluaciones360_create.select_area_evaluar()
    evaluaciones360_create.select_empleado_evaluar_1(input_chip_xpath, opcion_deseada_1)
    evaluaciones360_create.select_empleado_evaluar_2(input_chip_xpath_2, opcion_deseada_2)
    evaluaciones360_create.select_boton_sig()
    evaluaciones360_create.create_evaluadores()
    evaluaciones360_create.create_periodos(fecha_deseada)


    

