from pages.administracion.ajustes_de_usuario.roles.edit.roles_edit_page import Edit_Roles
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
    
def test_edit_roles(browser):
    
    edit_roles = Edit_Roles(browser)
    edit_roles.login()
    url_apartado_index = "https://192.168.9.78/admin/roles"
    edit_roles.ruta_roles_index(url_apartado_index)
    edit_roles.edit_roles(campo_buscar_xpath, trespuntos_btn_xpath, boton_editar, mi_calendario, guardar_xpath)
 
#Variables
campo_buscar_xpath= "(//INPUT[@type='search'])[2]"
trespuntos_btn_xpath = "//BUTTON[@class='btn btn-action-show-datatables-global d-none']"
boton_editar = "(//A[@class='mr-2 rounded btn btn-sm'])[2] "
mi_calendario = "(//TD[@class=' select-checkbox'])[4]"
guardar_xpath = "//BUTTON[contains(@class, 'btn') and contains(@class, 'btn-danger') and normalize-space()='Guardar']"

