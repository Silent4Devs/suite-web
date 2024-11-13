from pages.administracion.configurar_c_humano.categoria_de_capacitaciones.edit.categoria_de_c_edit_page import Edit_Categoria_de_Capacitaciones
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

def test_edit_categoria_de_capacitaciones(browser) :
    
    edit_categoria_capacitaciones = Edit_Categoria_de_Capacitaciones(browser)
    edit_categoria_capacitaciones.login()
    edit_categoria_capacitaciones.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)
    edit_categoria_capacitaciones.update_categoria_de_capacitaciones(campo_buscar_xpath, trespuntos_btn_xpath, btn2_editar, guardar_xpath)
    
#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_modulo = "(//A[@href='#'])[4]"
element_entrar_submodulo = "//a[@href='https://192.168.9.78/admin/categoria-capacitacion'][normalize-space()='Categorías de Capacitaciones']"

campo_buscar_xpath= "(//INPUT[@type='search'])[2]"
trespuntos_btn_xpath= "(//BUTTON[@class='btn btn-action-show-datatables-global d-none'])[1]"
btn2_editar = "(//I[@class='fas fa-edit'])[1]"
guardar_xpath = "//BUTTON[@class='btn btn-primary' and normalize-space()='Guardar']"


