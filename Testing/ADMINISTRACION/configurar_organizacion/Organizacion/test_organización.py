import time
import pytest
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException

#TEST ORGANIZACION

#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/organizacions'][text()='Organización']"
element_confirgurar_organizacion = "(//I[@class='material-symbols-outlined i-direct'][text()='keyboard_arrow_down'])[2]"
agregar_btn_xpath= "//a[contains(@href,'/admin/organizacions/') and contains(@href,'/edit') and normalize-space()='Editar Organización']"
trespuntos_btn_xpath= "//I[@class='fa-solid fa-ellipsis-vertical']"
boton_editar = "//I[@class='fas fa-edit']"
campo_buscar_xpath= "(//INPUT[@type='search'])[2]"
guardar_xpath = "//BUTTON[contains(@class, 'btn') and contains(@class, 'btn-danger') and normalize-space()='Guardar']"
panel_de_control = "//a[contains(@class, 'btn') and contains(@class, 'btn-success') and normalize-space()='Panel de Control']"
#Temporizadores
tiempo_modulos = 4
tiempo_carga = 10
tiempo_espera = 2.5
tiempo_tres = 3

@pytest.fixture(scope="module")
def browser():
    driver = webdriver.Firefox()
    yield driver
    driver.quit()

def login(driver, username, password):
    
    # Abrir la URL de Tabantaj
    driver.get('https://192.168.9.78/')

    # Maximizar la ventana del navegador
    driver.maximize_window()
    
    time.sleep(tiempo_modulos)
    
    print("------ LOGIN - TABANTAJ -----")
    
    #Correo
    correo = WebDriverWait(driver, 3).until(
        EC.visibility_of_element_located((By.XPATH, "//INPUT[@id='email']"))
    )
    correo.click()
    correo.send_keys(username)
    print("Correo ingresado")

    #Contraseña
    camp_password = WebDriverWait(driver, 3).until(
        EC.visibility_of_element_located((By.XPATH, "//INPUT[@id='password']"))
    )
    camp_password.click()
    camp_password.send_keys(password)
    print("Contraseña ingresada")

    #Boton enviar
    btn_enviar = WebDriverWait(driver, 3).until(
        EC.element_to_be_clickable((By.XPATH, "//button[@type='submit'][contains(text(),'Enviar')]"))
    )
    btn_enviar.click()
    print("Enviando credenciales de acceso")

    WebDriverWait(driver, 2).until(
        EC.presence_of_element_located((By.CSS_SELECTOR, "img[alt='Logo Tabantaj']"))
    )
    print("Login correcto")
    print("URL actual:", driver.current_url)

def test_login(browser):
    
    username = "admin@admin.com"
    password = "#S3cur3P4$$w0Rd!"

    login(browser, username, password)
    

##########################################Entrar a Modulo y Submodulo
    
def in_submodulo(driver):
    
    #Menu Hamburguesa
    print("Ingresando a Menu Hamburguesa")
    menu_hamb = WebDriverWait(driver, 3).until(
        EC.element_to_be_clickable((By.XPATH, menu_hamburguesa))
    )
    menu_hamb.click()

    time.sleep(tiempo_modulos)
    
    #Modulo Configurar Organizacion
    print("Ingresando a Moldulo Configurar Organizacion")
    modulo = WebDriverWait(driver, 3).until(
        EC.element_to_be_clickable((By.XPATH, element_confirgurar_organizacion))
    )
    modulo.click()
    
    time.sleep(tiempo_modulos)
    
    #Submodulo Clasificacion
    print("Ingresando a Submenu Clasificacion")
    sub_modulo= WebDriverWait(driver, 3).until(
        EC.element_to_be_clickable((By.XPATH, element_entrar_submodulo))
    )
    sub_modulo.click()
    
    time.sleep(tiempo_modulos)
    
    print("URL actual:", driver.current_url)

def test_in_submodulo(browser):

    in_submodulo(browser)

########################################## Editar Organizacion

def edit_organizacion(driver):
    
    # Dando clic en editar organización
    print("Dando clic al botón editar Organizacion..")
    wait = WebDriverWait(driver, 10)
    agregar_btn = wait.until(EC.presence_of_element_located((By.XPATH, agregar_btn_xpath)))
    agregar_btn.click()
    
    time.sleep(tiempo_modulos)
    
    # Correo
    campo_correo = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//INPUT[@id='correo']"))
        )
    campo_correo.click()
    campo_correo.clear()
    campo_correo.send_keys("correo_prueba@silent4business.com")

    time.sleep(tiempo_modulos)
    
    # Giro
    campo_giro = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//INPUT[@id='giro']"))
        )
    campo_giro.click()
    campo_giro.clear()
    campo_giro.send_keys("Empresa de Ciberseguridad de Prueba")

    time.sleep(tiempo_modulos)
    
    # Guardar Repositorio
    print("Dando clic al botón Guardar...")
    guardar = WebDriverWait(driver, 20).until(
        EC.element_to_be_clickable((By.XPATH, guardar_xpath))
    )
    guardar.click()

    time.sleep(tiempo_modulos)
    
    print("URL actual:", driver.current_url)

def test_edit_submodulo(browser):

    edit_organizacion(browser)

########################################## Panel de Control

def edit_panel_de_control(driver):
    
    time.sleep(tiempo_carga)
    
    # Dando clic en Panel de Control
    print("Dando clic al botón Panel de Control..")
    wait = WebDriverWait(driver, 10)
    btn_panel_d_control = wait.until(EC.presence_of_element_located((By.XPATH, panel_de_control)))
    btn_panel_d_control.click()
    
    time.sleep(tiempo_modulos)
    
    # Logo
    
    campo_logo = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//SPAN[@class='c-switch-slider'])[1]"))
        )
    campo_logo.click()
   

    time.sleep(tiempo_modulos)

    # Telefono
    
    campo_telefono = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//SPAN[@class='c-switch-slider'])[6]"))
    )
    campo_telefono.click()
   

    time.sleep(tiempo_modulos)
    
    # Correo
    
    campo_correo = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//SPAN[@class='c-switch-slider'])[7]"))
    )
    campo_correo.click()

    time.sleep(tiempo_modulos)
    
    driver.back()
    
    print("URL actual:", driver.current_url)

def test_panel_de_control(browser):

    edit_panel_de_control(browser)
