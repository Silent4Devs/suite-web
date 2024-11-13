from pages.administracion.configurar_organizacion.sedes.edit.sedes_edit_page import Edit_sedes
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
    
def test_edit_sedes(browser):
    
 sedes_edit = Edit_sedes(browser)
 sedes_edit.login()
 url_sedes_index = "https://192.168.9.78/admin/sedes"
 sedes_edit.ruta_sedes_index(url_sedes_index)
 sedes_edit.adit_sedes(campo_buscar_xpath, trespuntos_btn_xpath, boton_editar, descripcion, guardar_xpath)
 
#Variables
campo_buscar_xpath= "(//INPUT[@type='search'])[2]"
trespuntos_btn_xpath= "//I[@class='fa-solid fa-ellipsis-vertical']"
boton_editar = "//I[@class='fas fa-edit']"
descripcion = "//TEXTAREA[@id='descripcion']"
guardar_xpath = "//BUTTON[contains(@class, 'btn') and contains(@class, 'btn-danger') and normalize-space()='Guardar']"