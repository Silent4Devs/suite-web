import time
import pytest
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException

#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/auditorias/clausulas-auditorias'][text()='Cláusula']"
element_confirgurar_organizacion = "//I[@class='bi bi-file-earmark-arrow-up']"
agregar_btn_xpath= "//A[@href='https://192.168.9.78/admin/auditorias/clausulas-auditorias/create'][text()='Nueva Cláusula']"
trespuntos_btn_xpath= "(//I[@class='fa-solid fa-ellipsis-vertical'])[1]"
boton_editar = "(//I[@class='fa-solid fa-pencil'])[1]"
campo_buscar_xpath= "(//INPUT[@type='search'])[2]"

#Temporizadores
tiempo_modulos = 5
tiempo_carga = 10
tiempo_espera = 2.5

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
    
    #Modulo Ajustes SG
    print("Ingresando a Moldulo Ajustes SG")
    menu_sg = WebDriverWait(driver, 3).until(
        EC.element_to_be_clickable((By.XPATH, element_confirgurar_organizacion))
    )
    menu_sg.click()
    
    time.sleep(tiempo_modulos)
    
    #Submodulo Clausula
    print("Ingresando a Submenu Clausula")
    sub_clasif= WebDriverWait(driver, 3).until(
        EC.element_to_be_clickable((By.XPATH, element_entrar_submodulo))
    )
    sub_clasif.click()
    
    time.sleep(tiempo_modulos)
    
    print("URL actual:", driver.current_url)

def test_in_submodulo(browser):

    in_submodulo(browser)

########################################## Agregar Clasificacion y llenar repositorio

def add_clausula(driver):
    
    # Dando clic en Boton Agregar
    print("Dando clic al botón Agregar..")
    wait = WebDriverWait(driver, 10)
    agregar_btn = wait.until(EC.presence_of_element_located((By.XPATH, agregar_btn_xpath)))
    agregar_btn.click()
    
    time.sleep(tiempo_modulos)
    
   # ID
    campo_id = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//INPUT[@id='identificador']"))
        )
    campo_id.click()
    campo_id.send_keys("11717")

    time.sleep(tiempo_modulos)
    
    # Clausula
    campo_clasificacion = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//INPUT[@id='nombre']"))
        )
    campo_clasificacion.click()
    campo_clasificacion.send_keys("Clausula de Prueba")

    time.sleep(tiempo_modulos)
    
    # Descripcion
    campo_descripcion = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//TEXTAREA[@id='descripcion']"))
        )
    campo_descripcion.click()
    campo_descripcion.send_keys("Descripcion de Prueba")
 
    time.sleep(tiempo_modulos)
    
    # Guardar
    guardar_xpath = "//button[@class='btn btn-danger' and normalize-space()='Guardar']"
    guardar = WebDriverWait(driver, 20).until(
        EC.element_to_be_clickable((By.XPATH, guardar_xpath))
    )
    guardar.click()

    time.sleep(tiempo_modulos)
    
    print("URL actual:", driver.current_url)

def test_add_submodulo(browser):

    add_clausula(browser)
    
################################################### BUSCAR Y ACTUALIZAR CLASIFICACION

def update_clausula(driver):
    
    time.sleep(tiempo_carga)
     # Campo Buscar
    campo_entrada = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, campo_buscar_xpath))
    )
    campo_entrada.clear()
    campo_entrada.send_keys("Clausula de Prueba")

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
    btn_editar = wait.until(EC.presence_of_element_located((By.XPATH, boton_editar)))
    # Ahora intenta hacer clic en el elemento
    btn_editar.click()

    time.sleep(tiempo_modulos)  
    
   # Descripcion
    campo_descripcion = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//TEXTAREA[@id='descripcion']"))
        )
    campo_descripcion.click()
    campo_descripcion.clear()
    campo_descripcion.send_keys("Descripcion de Prueba Actualizado")

    time.sleep(tiempo_modulos)

    # Guardar actualización
    print("Dando clic al botón Guardar para guardar actualización...")
    guardar_xpath = "//button[@class='btn btn-danger' and normalize-space()='Guardar']"
    guardar = WebDriverWait(driver, 20).until(
        EC.element_to_be_clickable((By.XPATH, guardar_xpath))
    )
    guardar.click()
    
    time.sleep(tiempo_modulos)
    
    print("URL actual:", driver.current_url)
    
def test_update_submodulo(browser):

    update_clausula(browser)
