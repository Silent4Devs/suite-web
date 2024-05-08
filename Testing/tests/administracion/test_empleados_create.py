from pages.administracion.configurar_c_humano.empleados.create.empleados_create_page import Create_Empleados
from selenium.webdriver.chrome.options import Options as ChromeOptions
from selenium.webdriver.firefox.options import Options as FirefoxOptions
from selenium import webdriver
import pytest
"""
@pytest.fixture(scope="session")
def browser():
    options = FirefoxOptions()
    options.add_argument('--headless')
    options.add_argument('--disable-gpu')
    options.add_argument('--no-sandbox')
    options.add_argument('--disable-dev-shm-usage')
 
 
    options.add_argument('--disable-extensions')
    options.add_argument('--disable-dev-shm-usage')
    options.add_argument('--disable-browser-side-navigation')
    options.add_argument('--disable-gpu')
    options.add_argument('--no-sandbox')
    options.add_argument('--log-level=3')
 
    #driver = webdriver.Chrome(options=options)
    driver = webdriver.Firefox(options=options)
    yield driver
    driver.quit()
"""
def test_create_empleados(browser) :
    
    empleado_create = Create_Empleados(browser)
    empleado_create.login()
    url_apartado_index = "https://192.168.9.78/admin/empleados"
    empleado_create.ruta_empleados_index(url_apartado_index)
    empleado_create.add_empleados(agregar_btn)
    empleado_create.select_nombre(nombre)
    empleado_create.select_area(area)
    empleado_create.select_puesto(puesto)
    empleado_create.select_jefe(jefe)
    empleado_create.select_nivel_jerarquico(nivel_jerarquico)
    empleado_create.select_sexo(sexo)
    empleado_create.select_correo(correo)
    empleado_create.select_sede(sede)
    empleado_create.select_fecha(fecha_ingreso)
    empleado_create.select_guardar(guardar_xpath)

#Variables
agregar_btn= "//A[@href='https://192.168.9.78/admin/empleados/create'][text()='Registrar Empleados']"
nombre = "//INPUT[@id='name']"
area = "//span[@class='select2-selection__rendered'][contains(.,'-- Selecciona un área --')]"
puesto = "//SPAN[@id='select2-puesto_id-container']"
jefe = "//SPAN[@id='select2-inputGroupSelect01-container']"
nivel_jerarquico = "//SPAN[@id='select2-perfil_empleado_id-container']"
sexo = "//span[contains(@id,'select2-genero-container')]"
correo = "//INPUT[@id='email']"
sede = "//SPAN[@id='select2-sede_id-container']"
fecha_ingreso = "//INPUT[@id='antiguedad']"
guardar_xpath = "//BUTTON[@class='btn btn-primary' and normalize-space()='Guardar']"


