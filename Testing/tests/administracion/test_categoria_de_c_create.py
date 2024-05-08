from pages.administracion.configurar_c_humano.categoria_de_capacitaciones.create.categoria_de_c_create_page import Create_Categoria_de_Capacitaciones
from selenium.webdriver.chrome.options import Options as ChromeOptions
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
 
    #driver = webdriver.Chrome(options=options)
    driver = webdriver.Firefox(options=options)
    yield driver
    driver.quit()

def test_create_categoria_de_capacitaciones(browser) :
    
    create_categoria_capacitaciones = Create_Categoria_de_Capacitaciones(browser)
    create_categoria_capacitaciones.login()
    url_apartado_index = "https://192.168.9.78/admin/categoria-capacitacion"
    create_categoria_capacitaciones.ruta_categoria_de_c_index(url_apartado_index)
    create_categoria_capacitaciones.add_categoria_de_capacitaciones(agregar_btn_xpath, nombre_categoria, guardar_xpath)
    
#Variables
agregar_btn_xpath= "//a[@href='https://192.168.9.78/admin/categoria-capacitacion/create'][contains(.,'Registrar Categoría de capacitacion')]"
nombre_categoria = "//INPUT[@id='nombre']"
guardar_xpath = "//BUTTON[@class='btn btn-primary' and normalize-space()='Guardar']"


