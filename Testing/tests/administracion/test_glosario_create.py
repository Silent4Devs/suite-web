from pages.administracion.configurar_organizacion.glosario.create.glosario_create_page import Create_Glosario
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
         
def test_create_glosario(browser):
    
    create_glosario = Create_Glosario(browser)
    create_glosario.login()
    url_glosario_index = "https://192.168.9.78/admin/glosarios"
    create_glosario.ruta_glosario_index(url_glosario_index)
    create_glosario.add_glosario(agregar_btn_xpath, inciso, norma, concepto, definicion, explicacion, guardar_xpath)
 
#Variables

agregar_btn_xpath= "//BUTTON[@class='btn btn-xs btn-outline-success rounded ml-2 pr-3']"
inciso = "//INPUT[@id='numero']"
norma = "//INPUT[@id='norma']"
concepto = "//INPUT[@id='concepto']"
definicion = "//TEXTAREA[@id='definicion']"
explicacion = "//TEXTAREA[@id='explicacion']"
guardar_xpath = "//button[contains(@class, 'btn-danger') and normalize-space(text())='Guardar']"

