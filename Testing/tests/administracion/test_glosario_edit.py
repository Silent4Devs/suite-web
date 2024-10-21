import pytest
from selenium import webdriver
from selenium.webdriver.firefox.options import Options as FirefoxOptions
from pages.administracion.configurar_organizacion.glosario.edit.glosario_edit_page import Edit_Gloario

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
    
def test_edit_glosario(browser):
    
    glosario_edit = Edit_Gloario(browser)
    glosario_edit.login()
    url_glosario_index = "https://192.168.9.78/admin/glosarios"
    glosario_edit.ruta_glosario_index(url_glosario_index)
    glosario_edit.edit_glosario(campo_buscar_xpath, boton_editar, definicion, guardar_xpath)
 
#Variables


campo_buscar_xpath= "(//INPUT[@type='search'])[2]"
boton_editar = "(//I[@class='fas fa-edit'])[1]"
definicion = "//TEXTAREA[@id='definicion']"
guardar_xpath = "//button[contains(@class, 'btn-danger') and normalize-space(text())='Guardar']"