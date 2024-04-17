from pages.administracion.configurar_organizacion.procesos.edit.procesos_edit_page import Edit_Procesos
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
    
def test_edit_procesos(browser):
    
 edit_procesos = Edit_Procesos(browser)
 edit_procesos.login()
 url_procesos_index = "https://192.168.9.78/admin/procesos"
 edit_procesos.ruta_procesos_index(url_procesos_index)
 edit_procesos.edit_procesos(campo_buscar_xpath, boton_editar, descripcion, guardar_xpath)
 
#Variables
campo_buscar_xpath= "(//INPUT[@type='search'])[2]"
boton_editar = "//I[@class='fas fa-edit']"
descripcion = "//TEXTAREA[@id='descripcion']"
guardar_xpath = "//button[contains(@class, 'btn-danger') and normalize-space(text())='Guardar']"