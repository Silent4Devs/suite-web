from pages.administracion.configurar_organizacion.lista_informativa.view.lista_informativa_view_page import Lista_Informativa
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
    
    driver = webdriver.Firefox(options=options)
    yield driver
    driver.quit()  
    
def test_view_lista_informativa(browser):
    
 view_ListaInformativa = Lista_Informativa(browser)
 view_ListaInformativa()
 view_ListaInformativa.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)
 
#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_modulo = "(//A[@href='#'])[3]"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/lista-informativa'][text()='Lista Informativa']"
agregar_btn_xpath= "//BUTTON[@class='btn btn-xs btn-outline-success rounded ml-2 pr-3']"
guardar_xpath = "//button[contains(@class, 'btn-danger') and normalize-space(text())='Guardar']"


