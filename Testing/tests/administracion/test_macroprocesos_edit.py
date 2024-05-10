from pages.administracion.configurar_organizacion.macroprocesos.edit.macroprocesos_edit_page import Macroprocesos_Edit_Areas
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
    
def test_macroprocesos_edit(browser):
    
 edit_macroprocesos = Macroprocesos_Edit_Areas(browser)
 edit_macroprocesos.login()
 url_macroprocesos_index = "https://192.168.9.78/admin/macroprocesos"
 edit_macroprocesos.ruta_macroprocesos_index(url_macroprocesos_index)
 edit_macroprocesos.edit_macroprocesos(campo_buscar_xpath, trespuntos_btn_xpath, boton_editar, descripcion, guardar_xpath)
 
#Variables

campo_buscar_xpath= "(//INPUT[@type='search'])[2]"
trespuntos_btn_xpath= "//I[@class='fa-solid fa-ellipsis-vertical']"
boton_editar = "//I[@class='fas fa-edit']"
descripcion = "//TEXTAREA[@id='descripcion']"
guardar_xpath = "//button[contains(@class, 'btn-danger') and normalize-space(text())='Guardar']"


