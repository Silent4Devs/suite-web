from pages.administracion.ajustes_de_usuario.roles.create.roles_create_page import Create_Roles
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
    
def test_create_roles(browser):
    
    roles_create = Create_Roles(browser)
    roles_create.login()
    url_apartado_index = "https://192.168.9.78/admin/roles"
    roles_create.ruta_roles_index(url_apartado_index)
    roles_create.add_roles(agregar_btn_xpath, rol, mi_perfil, mis_datos, perfil_de_puesto , carrusel, mis_competencias, calendario, guardar_xpath)
 
#Variables

agregar_btn_xpath= "//BUTTON[@class='btn btn-xs btn-outline-success rounded ml-2 pr-3 agregar']"
rol = "//INPUT[@id='title']"
mi_perfil = "(//TD[@class=' select-checkbox'])[2]"
mis_datos =  "(//TD[@class=' select-checkbox'])[3]"
perfil_de_puesto = "(//TD[@class=' select-checkbox'])[5]"
carrusel = "//A[@href='#'][text()='3']"
mis_competencias = "(//TD[@class=' select-checkbox'])[1]"
calendario = "(//TD[@class=' select-checkbox'])[3]"
guardar_xpath = "//BUTTON[@id='btnEnviarPermisos']"

