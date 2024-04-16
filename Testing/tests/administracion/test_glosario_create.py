from pages.administracion.configurar_organizacion.glosario.create.glosario_create_page import Create_Glosario
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
    
    driver = webdriver.Firefox(options=options)
    yield driver
    driver.quit()  """
         
def test_create_glosario(browser):
    
    create_glosario = Create_Glosario(browser)
    create_glosario.login()
    create_glosario.in_menu_h(menu_hamburguesa)

    create_glosario.in_modulo(modulo, modulo_css)
    create_glosario.in_submodulo(submodulo)
    create_glosario.add_glosario(agregar_btn_xpath, guardar_xpath)
 
#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
modulo = "(//A[@href='#'])[3]"
modulo_css = "a[href='#']:nth-of-type(3)"
submodulo = "//A[@href='https://192.168.9.78/admin/glosarios'][text()='Glosario']"

agregar_btn_xpath= "//BUTTON[@class='btn btn-xs btn-outline-success rounded ml-2 pr-3']"
guardar_xpath = "//button[contains(@class, 'btn-danger') and normalize-space(text())='Guardar']"

