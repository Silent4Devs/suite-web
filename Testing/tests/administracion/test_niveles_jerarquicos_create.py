from pages.administracion.configurar_c_humano.niveles_jerarquicos.create.niveles_jerarquicos_create_page import Create_Niveles_Jerarquicos
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


def test_create_niveles_jerarquicos(browser) :
    
    niveles_jerarquicos_create = Create_Niveles_Jerarquicos(browser)
    niveles_jerarquicos_create.login()
    niveles_jerarquicos_create.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)
    niveles_jerarquicos_create.add_niveles_jerarquicos(agregar_btn_xpath, guardar_xpath)
    
#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_modulo = "(//A[@href='#'])[4]"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/perfiles'][text()='Niveles Jerárquicos']"

agregar_btn_xpath= "//A[@href='https://192.168.9.78/admin/perfiles/create'][text()='Registrar Nivel Jerárquico']"
guardar_xpath = "//BUTTON[@class='btn btn-primary' and normalize-space()='Guardar']"


