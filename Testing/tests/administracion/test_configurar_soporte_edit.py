from pages.administracion.ajustes_de_sistema.configurar_soporte.edit.configurar_soporte_edit_page import Edit_configurar_soporte
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
    
def test_configurar_soporte_edit(browser):
    
 configurar_soporte_edit = Edit_configurar_soporte(browser)
 configurar_soporte_edit.login()
 url_apartado_index = "https://192.168.9.78/admin/configurar-soporte"
 configurar_soporte_edit.ruta_configurar_soporte_index(url_apartado_index)
 configurar_soporte_edit.edit_configurarsoporte(btn_serch, btn_3Puntos, editar, rol, empleado, guardar_xpath)

#Variables

btn_serch = "(//INPUT[@type='search'])[2]"
btn_3Puntos = "(//I[@class='fa-solid fa-ellipsis-vertical'])[1]"
editar = "(//A[@class='mr-2 rounded btn btn-sm'])[2]"
rol = "//SELECT[@id='rol']"
empleado = "//SELECT[@id='id_elaboro']"
guardar_xpath = "//button[contains(@class, 'btn') and contains(@class, 'btn-danger') and normalize-space(text()) = 'Guardar']"