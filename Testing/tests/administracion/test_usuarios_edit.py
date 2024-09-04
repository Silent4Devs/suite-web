from pages.administracion.ajustes_de_usuario.usuarios.create.usuarios_create_page import Create_Usuarios
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
    
def test_create_usuarios(browser):
    
    usuarios_create = Create_Usuarios(browser)
    usuarios_create.login()
    usuarios_create.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)
    usuarios_create.add_usuarios(campo_buscar_xpath, boton_editar, guardar_xpath)
 
#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_modulo = "(//A[@href='#'])[6]"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/users'][text()='Usuarios']"

campo_buscar_xpath= "(//INPUT[@type='search'])[2]"
boton_editar = "//I[@class='fas fa-edit']"
guardar_xpath = "//BUTTON[contains(@class, 'btn') and contains(@class, 'btn-danger') and normalize-space()='Guardar']"

