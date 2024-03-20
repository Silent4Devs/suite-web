import time
import pytest
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException

#Variables
element_confirgurar_organizacion = "(//A[@href='#'])[4]"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/panel-organizacion'][text()='Mi Organización']"
agregar_btn_xpath= "//A[@href='https://192.168.9.78/admin/empleados/create'][text()='Registrar Empleados']"
save_btn_xpath="//button[@class='btn btn-danger'][contains(.,'Guardar')]"
campo_buscar_xpath= "(//INPUT[@type='search'])[2]"
btn2_editar = "(//I[@class='fas fa-edit'])[1]"
trespuntos_btn_xpath= "(//BUTTON[@class='btn btn-action-show-datatables-global d-none'])[1]"
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"


#Temporizadores
tiempo_modulos = 6
tiempo_carga = 10
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
      
    # Entrando a Modulo Configurar Vistas
    print("Entrando a Configurar Vistas...")
    element = driver.find_element(By.XPATH, element_confirgurar_organizacion)
    driver.execute_script("arguments[0].scrollIntoView(true);", element)
    WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, element_confirgurar_organizacion)))
    print("Dando clic en Configurar Vistas...")
    element.click()
    
    time.sleep(tiempo_modulos)

    # Entrando a Sub Modulo Mi Organizacion
    print("Entrando a Sub Modulo Mi Organizacion...")
    entrar = driver.find_element(By.XPATH,element_entrar_submodulo)
    driver.execute_script("arguments[0].scrollIntoView(true);", element)
    WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH,element_entrar_submodulo)))
    print("Dando clic en Sub Modulo Mi Organizacion...")
    entrar.click()
    
    time.sleep(tiempo_modulos)
    
def test_in_modulos(browser):
    
    in_modulos(browser)

    
##################################################### AGREGAR Y LLENAR REPOSITORIO ######################################

def check_mi_organizacion(driver):

    # Logo
    
    campo_logo = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//SPAN[@class='c-switch-slider'])[1]"))
        )
    campo_logo.click()
    print("Dando clic en campo Logo")
   

    time.sleep(tiempo_espera)

    # Telefono
    
    campo_telefono = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//SPAN[@class='c-switch-slider'])[6]"))
    )
    campo_telefono.click()
    print("Dando clic en campo Telefono")

    time.sleep(tiempo_espera)
    
    # Correo
    
    campo_correo = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//SPAN[@class='c-switch-slider'])[7]"))
    )
    campo_correo.click()
    print("Dando clic en campo Correo")

    time.sleep(tiempo_espera)
    
    driver.back()
    print("Regresando a pantalla de inicio")
    
def test_check_mi_organizacion(browser):
    
    check_mi_organizacion(browser)
    
############################## ENTRANDO DE NUEVO AL SUBMODULO PARA COMPROBAR CAMBIOS

def review_mi_organizacion(driver):

    time.sleep(tiempo_modulos)
    
    # Entrando de nuevo a Menu Hamburguesa
    print("URL actual:", driver.current_url)
    print("Entrando de nuevo a Menu Hamburguesa...")
    element = driver.find_element(By.XPATH, menu_hamburguesa)
    driver.execute_script("arguments[0].scrollIntoView(true);", element)
    WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, menu_hamburguesa)))
    print("Dando clic ende nuevo a Menu Hamburguesa...")
    element.click()
    
    time.sleep(tiempo_modulos)
    
    
    # Entrando a Modulo Configurar Vistas
    print("Entrando de nuevo a Configurar Vistas...")
    element = driver.find_element(By.XPATH, element_confirgurar_organizacion)
    driver.execute_script("arguments[0].scrollIntoView(true);", element)
    WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, element_confirgurar_organizacion)))
    print("Dando clic de nuevo en Configurar Vistas...")
    element.click()
    
    time.sleep(tiempo_modulos)

    # Entrando a Sub Modulo Mis datos
    print("Entrando de nuevo a Sub Modulo Mi Organizacion...")
    entrar = driver.find_element(By.XPATH,element_entrar_submodulo)
    driver.execute_script("arguments[0].scrollIntoView(true);", element)
    WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH,element_entrar_submodulo)))
    print("Dando clic de nuevo en Sub Modulo Mi Organizacion...")
    entrar.click()
    
    time.sleep(tiempo_modulos)
    
    driver.back()
    print("Regresando a pantalla de inicio")

def test_review_mi_organizacion(browser):
    
    review_mi_organizacion(browser)
#HOLA