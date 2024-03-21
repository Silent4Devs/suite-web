import time
import pytest
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException

#TEST PROCESOS

#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/procesos'][text()='Procesos']"
element_confirgurar_organizacion = "(//I[@class='material-symbols-outlined i-direct'][text()='keyboard_arrow_down'])[2]"
agregar_btn_xpath= "//A[@href='https://192.168.9.78/admin/procesos/create'][text()='Registrar Proceso']"
trespuntos_btn_xpath= "//I[@class='fa-solid fa-ellipsis-vertical']"
boton_editar = "//I[@class='fas fa-edit']"
campo_buscar_xpath= "(//INPUT[@type='search'])[2]"
guardar_xpath = "//BUTTON[contains(@class, 'btn') and contains(@class, 'btn-danger') and normalize-space()='Guardar']"

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
    
def login (driver):

    # Abrir la URL de Tabantaj
    driver.get('https://192.168.9.78/')

    # Maximizar la ventana del navegador
    driver.maximize_window()
    time.sleep(5)

    # Ingresar credenciales
    usuario = driver.find_element(By.XPATH, "//input[contains(@name,'email')]").send_keys("admin@admin.com")
    print("Introduciendo Correo")
    time.sleep(tiempo_modulos)
    password = driver.find_element(By.XPATH, "//input[contains(@name,'password')]").send_keys("#S3cur3P4$$w0Rd!")
    print("Introduciendo Contraseña")
    time.sleep(tiempo_modulos)

    # Hacer clic en el botón de envío
    btn = driver.find_element(By.XPATH, "//button[@type='submit'][contains(.,'Enviar')]")
    btn.click()
    print("Haciendo clic en boton enviar")
    
    WebDriverWait(driver, 2).until(
        EC.presence_of_element_located((By.CSS_SELECTOR, "img[alt='Logo Tabantaj']"))
    ) 
    print("Login correcto")
    
    print("URL actual:", driver.current_url)
    
def test_login(browser):
    
    login(browser)
    
################################################## Entrar a Modulos y Submodulos

def in_modulos(driver):
    
    time.sleep(tiempo_modulos)
        
    # Entrando a Menu Hamburguesa
    print("URL actual:", driver.current_url)
    print("Entrando a Menu Hamburguesa...")
    element = driver.find_element(By.XPATH, menu_hamburguesa)
    driver.execute_script("arguments[0].scrollIntoView(true);", element)
    WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, menu_hamburguesa)))
    print("Dando clic en Menu Hamburguesa...")
    element.click()

    time.sleep(tiempo_modulos)
    
    # Entrando a Modulo Configurar Organizacion
    print("Entrando a Configurar Organizacion...")
    element = driver.find_element(By.XPATH, element_confirgurar_organizacion)
    driver.execute_script("arguments[0].scrollIntoView(true);", element)
    WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, element_confirgurar_organizacion)))
    print("Dando clic en Configurar Organizacion...")
    element.click()
    
    time.sleep(tiempo_modulos)

    # Entrando a Sub Modulo Procesos 
    print("Entrando a Sub Modulo Procesos..")
    entrar = driver.find_element(By.XPATH,element_entrar_submodulo)
    driver.execute_script("arguments[0].scrollIntoView(true);", element)
    WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH,element_entrar_submodulo)))
    print("Dando clic en Sub Modulo Procesos...")
    entrar.click()
    
    time.sleep(tiempo_modulos)
    
    print("URL actual:", driver.current_url)

def test_in_modulos(browser):
    
    in_modulos(browser)

    
##################################################### AGREGAR Y LLENAR REPOSITORIO ####################################

def add_procesos(driver):
    
    # Dando clic en Boton Resgistrar Procesos
    print("Dando clic al botón registrar procesos...")
    wait = WebDriverWait(driver, 10)
    agregar_btn = wait.until(EC.presence_of_element_located((By.XPATH, agregar_btn_xpath)))
    agregar_btn.click()
    
    time.sleep(tiempo_modulos)
    
    # Codigo
    campo_codigo = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//INPUT[@id='codigo']"))
        )
    campo_codigo.click()
    campo_codigo.send_keys("000117")
    print("Escribiendo Campo Codigo")

    time.sleep(tiempo_modulos)
    
    # Nombre
    campo_nombre = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//INPUT[@id='nombre']"))
        )
    campo_nombre.click()
    campo_nombre.send_keys("Nombre de Prueba")
    print("Escribiendo Campo Nombre")

    time.sleep(tiempo_modulos)
    
    # Macroproceso
    campo_macroproceso = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//SELECT[@id='id_macroproceso']"))
        )
    campo_macroproceso.click()
    time.sleep(tiempo_espera)
    campo_macroproceso.send_keys("AFI")
    time.sleep(tiempo_espera)
    campo_macroproceso.click()
    print("Escribiendo Campo Macroproceso")
   
    time.sleep(tiempo_modulos)
    
    # Descripcion
    campo_descripcion = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//TEXTAREA[@id='descripcion']"))
        )
    campo_descripcion.click()
    campo_descripcion.send_keys("Descripcion de prueba")
    print("Escribiendo Campo Descripcion")
   
    time.sleep(tiempo_modulos)
    
    # Guardar Repositorio
    print("Dando clic al botón Guardar...")
    guardar = WebDriverWait(driver, 20).until(
        EC.element_to_be_clickable((By.XPATH, guardar_xpath))
    )
    guardar.click()
    
    print("URL actual:", driver.current_url)

def test_add_procesos(browser):
    
    add_procesos(browser)
    
#################################BUSCAR REPOSITORIO Y ENTRAR A BOTONES DE EDICION###################################

def update_procesos(driver):

    # Campo Buscar
    campo_buscar = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, campo_buscar_xpath))
    )
    campo_buscar.clear()
    campo_buscar.send_keys("5432122")
    print("Seleccionando campo buscar")

    time.sleep(tiempo_carga)
    
    # Boton editar
    print("Dando clic al botón editar...")
    wait = WebDriverWait(driver, 10)
    # Esperar a que el elemento esté presente en el DOM
    btn_editar = wait.until(EC.presence_of_element_located((By.XPATH,boton_editar)))
    # Ahora intenta hacer clic en el elemento
    btn_editar.click()

    time.sleep(tiempo_modulos)  
    
    # Descripcion
    campo_descripcion = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//TEXTAREA[@id='descripcion']"))
        )
    campo_descripcion.click()
    campo_descripcion.clear()
    campo_descripcion.send_keys("Descripcion de prueba actualiada")
    print("Escribiendo Campo Descripcion")
    
    time.sleep(tiempo_modulos)
    
    # Guardar actualización
    print("Dando clic al botón Guardar para guardar actualización...")
    guardar = WebDriverWait(driver, 20).until(
        EC.element_to_be_clickable((By.XPATH, guardar_xpath))
    )
    guardar.click()

    time.sleep(tiempo_modulos)
    
    print("URL actual:", driver.current_url)
    
def test_update_procesos(browser):
    
    update_procesos(browser)


