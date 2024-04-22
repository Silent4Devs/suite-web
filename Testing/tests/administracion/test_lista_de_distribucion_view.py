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
 url_apartado_index = "https://192.168.9.78/admin/lista-distribucion"
 lista_d_distribucion_view.ruta_clausula_index(url_apartado_index)
 lista_d_distribucion_view.view_lista_de_distribucion(trespuntos_btn_xpath, boton_view, regresar)

#Variables
trespuntos_btn_xpath= "(//I[@class='fa-solid fa-ellipsis-vertical'])[1]"
boton_view = "//A[@href='/admin/lista-distribucion/4/show']"
regresar = "//A[@id='btn_cancelar']"
