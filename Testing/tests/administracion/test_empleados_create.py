from pages.administracion.configurar_c_humano.empleados.create.empleados_create_page import Create_Empleados
from selenium.webdriver.chrome.options import Options as ChromeOptions
from selenium.webdriver.firefox.options import Options as FirefoxOptions
from selenium import webdriver
import pytest

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


def test_create_empleados(browser) :
    
    empleado_create = Create_Empleados(browser)
    empleado_create.login()
    empleado_create.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)
    empleado_create.add_empleados(agregar_btn_xpath, guardar_xpath)
    
#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_modulo = "(//A[@href='#'])[4]"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/empleados'][text()='Empleados']"

agregar_btn_xpath= "//A[@href='https://192.168.9.78/admin/empleados/create'][text()='Registrar Empleados']"
guardar_xpath = "//BUTTON[@class='btn btn-primary' and normalize-space()='Guardar']"


