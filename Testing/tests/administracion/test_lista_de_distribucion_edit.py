from pages.administracion.ajustes_sg.lista_de_distribucion.edit.lista_de_distribucion_edit_page import Edit_lista_de_distribucion
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
    
def test_lista_d_distribucion_edit(browser):
    
 lista_d_distribucion_edit = Edit_lista_de_distribucion(browser)
 lista_d_distribucion_edit.login()
 url_apartado_index = "https://192.168.9.78/admin/lista-distribucion"
 lista_d_distribucion_edit.ruta_clausula_index(url_apartado_index)
 lista_d_distribucion_edit.update_lista_de_distribucion(trespuntos_btn_xpath, boton_editar, super_aprobadores,guardar_xpath)

#Variables
trespuntos_btn_xpath= "(//I[@class='fa-solid fa-ellipsis-vertical'])[1]"
boton_editar = "//A[@href='/admin/lista-distribucion/4/edit']"
super_aprobadores = "(//SPAN[@class='select2-selection select2-selection--multiple'])[1]"
guardar_xpath = "//BUTTON[@type='submit'][text()='Editar']"

