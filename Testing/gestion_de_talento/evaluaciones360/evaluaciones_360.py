import time
import pytest
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException

#Variables
element_entrar_modulo = "//A[@href='https://192.168.9.78/admin/capital-humano']"
element_entrar_submodulo = "//a[@class='nav-link'][contains(.,'Evaluación 360')"
element_crear_evaluacion = "//A[@href='https://192.168.9.78/admin/recursos-humanos/evaluacion-360/evaluaciones/create']"

agregar_btn_xpath= "//BUTTON[@class='btn btn-xs btn-outline-success rounded ml-2 pr-3 agregar']"
save_btn_xpath="//button[@class='btn btn-danger'][contains(.,'Guardar')]"
campo_buscar_xpath= "(//INPUT[@type='search'])[2]"
btn2_editar = "(//I[@class='fas fa-edit'])[1]"
trespuntos_btn_xpath= "(//BUTTON[@class='btn btn-action-show-datatables-global d-none'])[1]"
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
guardar_xpath = "//BUTTON[@class='btn btn-danger'][normalize-space(text())='Guardar']"
boton_editar = "//I[@class='fas fa-edit']"

#Temporizadores
tiempo_modulos = 5
tiempo_carga = 30
tiempo_espera = 3

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
    time.sleep(tiempo_espera)
    password = driver.find_element(By.XPATH, "//input[contains(@name,'password')]").send_keys("#S3cur3P4$$w0Rd!")
    print("Introduciendo Contraseña")
    time.sleep(tiempo_espera)

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
    
    time.sleep(tiempo_espera)
      
    # Entrando a Gestión Talento 
    print("Entrando a Gestión Talento...")
    element = driver.find_element(By.XPATH, element_entrar_modulo)
    driver.execute_script("arguments[0].scrollIntoView(true);", element)
    WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, element_entrar_modulo)))
    print("Dando clic en Gestión Talento...")
    element.click()
    
    time.sleep(tiempo_carga)

    # Entrando a Sub Modulo Evalución 360
    print("Entrando a Sub Modulo Evalución 360...")
    entrar = driver.find_element(By.XPATH, element_entrar_submodulo)
    driver.execute_script("arguments[0].scrollIntoView(true);", element)
    WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, element_entrar_submodulo)))
    print("Dando clic en Sub Modulo Evalución 360...")
    entrar.click()
    
    time.sleep(tiempo_espera)
    
    # Entrando a Crear Evaluaciones
    print("Entrando a Crear Evaluaciones...")
    entrar = driver.find_element(By.XPATH,element_crear_evaluacion)
    driver.execute_script("arguments[0].scrollIntoView(true);", element)
    WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH,element_crear_evaluacion)))
    print("Dando clic en Crear Evaluaciones...")
    entrar.click()
    
    time.sleep(tiempo_espera)
    
    print("URL actual:", driver.current_url)
    
def test_in_modulos(browser):
    
    in_modulos(browser)

    
##################################################### AGREGAR Y LLENAR REPOSITORIO ######################################

"""

def add_configurar_soporte(driver):
    
    time.sleep(tiempo_carga)
    
    # Dando clic en Boton Agregar Configurar soporte
    print("Dando clic al botón Agregar ...")
    wait = WebDriverWait(driver, 10)
    agregar_btn = wait.until(EC.presence_of_element_located((By.XPATH, agregar_btn_xpath)))
    agregar_btn.click()
    
    time.sleep(tiempo_modulos)
    
    # Rol
    
    campo_rol = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//SELECT[@id='rol']"))
        )
    campo_rol.click()
    time.sleep(tiempo_espera)
    campo_rol.send_keys("Soporte técnico")
    time.sleep(tiempo_espera)
    campo_rol.click()
    print("Asignando Rol")
    
    time.sleep(tiempo_espera)
    
    # Empleado
    
    campo_empleado = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//SELECT[@id='id_elaboro']"))
        )
    campo_empleado.click()
    time.sleep(tiempo_espera)
    campo_empleado.send_keys("Benito López Mejía")
    time.sleep(tiempo_espera)
    campo_empleado.click()
    print("Asignando Empleado")
    
    time.sleep(tiempo_espera)

    # Guardar Repositorio
    print("Dando clic al botón Guardar...")
    guardar = WebDriverWait(driver, 20).until(
        EC.element_to_be_clickable((By.XPATH, guardar_xpath))
    )
    guardar.click()
    
    time.sleep(tiempo_espera)
    
    print("URL actual:", driver.current_url)
      
def test_add_configurar_soporte(browser):
    
    add_configurar_soporte(browser)
    
############################## ENTRANDO DE NUEVO AL SUBMODULO PARA COMPROBAR CAMBIOS 

def check_usuarios(driver):
    
    time.sleep(tiempo_carga)
    
    # Campo Buscar
    campo_entrada = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, campo_buscar_xpath))
    )
    campo_entrada.clear()
    campo_entrada.send_keys("Soporte técnico")

    time.sleep(tiempo_carga)

    
    print("URL actual:", driver.current_url)

    time.sleep(tiempo_modulos)  

    
def test_check_usuarios(browser):
    
    check_usuarios(browser)
    
"""