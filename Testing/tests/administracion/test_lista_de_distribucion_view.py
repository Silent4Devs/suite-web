from pages.administracion.ajustes_sg.lista_de_distribucion.view.lista_de_distribucion_view_page import Show_lista_de_distribucion
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
def test_lista_d_distribucion_view(browser):
    
 lista_d_distribucion_view = Show_lista_de_distribucion(browser)
 lista_d_distribucion_view.login()
 lista_d_distribucion_view.in_submodulo(menu_hamburguesa, element_confirgurar_organizacion, element_entrar_submodulo)
 lista_d_distribucion_view.view_lista_de_distribucion(trespuntos_btn_xpath, boton_view)

#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_submodulo = "//a[contains(@href, '/admin/lista-distribucion') and normalize-space()='Lista de distribución']"
element_confirgurar_organizacion = "//I[@class='bi bi-file-earmark-arrow-up']"
agregar_btn_xpath= "//BUTTON[@class='btn btn-xs btn-outline-success rounded ml-2 pr-3']"
trespuntos_btn_xpath= "(//I[@class='fa-solid fa-ellipsis-vertical'])[1]"
boton_view = "//A[@href='/admin/lista-distribucion/4/show']"

