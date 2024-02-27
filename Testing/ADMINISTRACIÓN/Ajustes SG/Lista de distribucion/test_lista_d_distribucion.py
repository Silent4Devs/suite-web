import time
import pytest
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException

#TEST LISTA DE DISTRIBUCION

#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_submodulo = "//a[contains(@href, '/admin/lista-distribucion') and normalize-space()='Lista de distribución']"
element_confirgurar_organizacion = "//I[@class='bi bi-file-earmark-arrow-up']"
agregar_btn_xpath= "//BUTTON[@class='btn btn-xs btn-outline-success rounded ml-2 pr-3']"
trespuntos_btn_xpath= "(//I[@class='fa-solid fa-ellipsis-vertical'])[1]"
boton_editar = "//A[@href='/admin/lista-distribucion/4/edit']"
campo_buscar_xpath= "(//INPUT[@type='search'])[2]"
guardar_xpath = "//BUTTON[@type='submit'][text()='Editar']"

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
    
######################################## LOGIN

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

########################################## Entrar a Modulo y Submodulo

def in_submodulo(driver):
    
    #Menu Hamburguesa
    print("Ingresando a Menu Hamburguesa")
    menu_hamb = WebDriverWait(driver, 3).until(
        EC.element_to_be_clickable((By.XPATH, menu_hamburguesa))
    )
    menu_hamb.click()

    time.sleep(tiempo_modulos)
    
    #Modulo Ajustes SG
    print("Ingresando a Moldulo Ajustes SG")
    modulo = WebDriverWait(driver, 3).until(
        EC.element_to_be_clickable((By.XPATH, element_confirgurar_organizacion))
    )
    modulo.click()
    
    time.sleep(tiempo_modulos)
    
    #Submodulo Lista de Distribucion 
    print("Ingresando a Submenu Clausula")
    sub_modulo= WebDriverWait(driver, 3).until(
        EC.element_to_be_clickable((By.XPATH, element_entrar_submodulo))
    )
    sub_modulo.click()
    
    time.sleep(tiempo_modulos)
    
    print("URL actual:", driver.current_url)

def test_in_submodulo(browser):

    in_submodulo(browser)

    
################################################### Buscar y actualizar clasificacion

def update_clasificacion(driver):
    
    time.sleep(tiempo_carga)
    
    # Boton 3 puntos
    print("Dando clic al botón 3 puntos...")
    wait = WebDriverWait(driver, 10)
    # Esperar a que el elemento esté presente en el DOM
    puntos_btn = wait.until(EC.presence_of_element_located((By.XPATH, trespuntos_btn_xpath)))
    # Ahora intenta hacer clic en el elemento
    puntos_btn.click()

    time.sleep(tiempo_modulos)
    
    # Boton editar
    print("Dando clic al botón editar...")
    wait = WebDriverWait(driver, 10)
    # Esperar a que el elemento esté presente en el DOM
    btn_editar = wait.until(EC.presence_of_element_located((By.XPATH,boton_editar)))
    # Ahora intenta hacer clic en el elemento
    btn_editar.click()

    time.sleep(tiempo_modulos)  
    
    # Seleccione niveles
    campo_niveles = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//SELECT[@id='niveles']"))
        )
    campo_niveles.click()
    time.sleep(tiempo_espera)
    campo_niveles.send_keys("2")
    time.sleep(tiempo_espera)
    campo_niveles.click()
    
    # Guardar actualización
    print("Dando clic al botón Guardar para guardar actualización...")
    guardar = WebDriverWait(driver, 20).until(
        EC.element_to_be_clickable((By.XPATH, guardar_xpath))
    )
    guardar.click()

    time.sleep(tiempo_modulos)

    
    print("URL actual:", driver.current_url)
    
def test_update_submodulo(browser):

    update_clasificacion(browser)



