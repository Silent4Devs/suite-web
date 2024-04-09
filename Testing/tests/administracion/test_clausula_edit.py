from pages.administracion.ajustes_sg.clausula.edit.clausula_edit_page import Edit_clausula
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
 
def test_clausula_edit(browser):
    
 clausula_edit = Edit_clausula(browser)
 clausula_edit.login()
 clausula_edit.in_submodulo(menu_hamburguesa, element_confirgurar_organizacion, element_entrar_submodulo)
 clausula_edit.update_clausula(campo_buscar_xpath, trespuntos_btn_xpath, boton_editar)

#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/auditorias/clausulas-auditorias'][text()='Cláusula']"
element_confirgurar_organizacion = "//I[@class='bi bi-file-earmark-arrow-up']"
trespuntos_btn_xpath= "(//I[@class='fa-solid fa-ellipsis-vertical'])[1]"
boton_editar = "(//I[@class='fa-solid fa-pencil'])[1]"
campo_buscar_xpath= "(//INPUT[@type='search'])[2]"

