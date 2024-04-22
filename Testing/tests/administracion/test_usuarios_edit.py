from pages.administracion.ajustes_de_usuario.usuarios.edit.usuarios_edit_page import Edit_Usuarios
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
    
    usuarios_edit = Edit_Usuarios(browser)
    usuarios_edit.login()
    url_apartado_index = "https://192.168.9.78/admin/users"
    usuarios_edit.ruta_usuarios_index(url_apartado_index)
    usuarios_edit.edit_usuarios(campo_buscar_xpath, boton_editar, correo, guardar_xpath)
 
#Variables
campo_buscar_xpath= "(//INPUT[@type='search'])[2]"
boton_editar = "//I[@class='fas fa-edit']"
correo = "//INPUT[@id='email']"
guardar_xpath = "//BUTTON[contains(@class, 'btn') and contains(@class, 'btn-danger') and normalize-space()='Guardar']"

