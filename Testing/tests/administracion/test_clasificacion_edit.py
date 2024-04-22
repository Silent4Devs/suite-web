from pages.administracion.ajustes_sg.clasificacion.ediit.clasifiacion_edit_page import Edit_clasificacion
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
    
def test_clasificacion_edit(browser):
    
 clasifiacion_edit = Edit_clasificacion(browser)
 clasifiacion_edit.login()
 url_apartado_index = "https://192.168.9.78/admin/auditorias/clasificacion-auditorias"
 clasifiacion_edit.ruta_clasificacion_index(url_apartado_index)
 clasifiacion_edit.update_clasificacion(campo_buscar_xpath, trespuntos_btn_xpath, boton_editar, descripcion, guardar_xpath)

#Variables
campo_buscar_xpath= "(//INPUT[@type='search'])[2]"
trespuntos_btn_xpath= "(//I[@class='fa-solid fa-ellipsis-vertical'])[1]"
boton_editar = "(//I[@class='fa-solid fa-pencil'])[1]"
descripcion = "//TEXTAREA[@id='descripcion']"
guardar_xpath = "//button[@class='btn btn-danger' and normalize-space()='Guardar']"




