import time
import pytest
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException

#Variables
element_confirgurar_organizacion = "(//A[@href='#'])[5]"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/roles'][text()='Roles']"
agregar_btn_xpath= "//BUTTON[@class='btn btn-xs btn-outline-success rounded ml-2 pr-3 agregar']"
save_btn_xpath="//button[@class='btn btn-danger'][contains(.,'Guardar')]"
campo_buscar_xpath= "(//INPUT[@type='search'])[2]"
btn2_editar = "(//I[@class='fas fa-edit'])[1]"
trespuntos_btn_xpath= "(//BUTTON[@class='btn btn-action-show-datatables-global d-none'])[1]"
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
guardar_xpath = "//BUTTON[@id='btnEnviarPermisos']"


#Temporizadores
tiempo_modulos = 6
tiempo_carga = 10
tiempo_espera = 2.5

@pytest.fixture
def driver():
    driver = webdriver.Firefox()
    yield driver
    driver.quit()
    

def test_empleados(driver):

    # Abrir la URL de Tabantaj
    driver.get('https://192.168.9.78/')

    # Maximizar la ventana del navegador
    driver.maximize_window()
    time.sleep(5)

    # Ingresar credenciales
    usuario = driver.find_element(By.XPATH, "//input[contains(@name,'email')]").send_keys("admin@admin.com")
    time.sleep(tiempo_modulos)
    password = driver.find_element(By.XPATH, "//input[contains(@name,'password')]").send_keys("#S3cur3P4$$w0Rd!")
    time.sleep(tiempo_modulos)

    # Hacer clic en el botón de envío
    btn = driver.find_element(By.XPATH, "//button[@type='submit'][contains(.,'Enviar')]")
    btn.click()
    
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
      
    # Entrando a Modulo Ajuste de Usuario
    print("Entrando a Ajuste de Usuario...")
    element = driver.find_element(By.XPATH, element_confirgurar_organizacion)
    driver.execute_script("arguments[0].scrollIntoView(true);", element)
    WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, element_confirgurar_organizacion)))
    print("Dando clic en Ajuste de Usuario...")
    element.click()
    
    time.sleep(tiempo_modulos)

    # Entrando a Sub Modulo Roles
    print("Entrando a Sub Modulo Roles...")
    entrar = driver.find_element(By.XPATH,element_entrar_submodulo)
    driver.execute_script("arguments[0].scrollIntoView(true);", element)
    WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH,element_entrar_submodulo)))
    print("Dando clic en Sub Modulo Roles...")
    entrar.click()
    
    time.sleep(tiempo_modulos)

    
    ##################################################### AGREGAR Y LLENAR REPOSITORIO ######################################
    
    # Dando clic en Boton Agregar Rol
    print("Dando clic al botón Agregar Crear Rol...")
    wait = WebDriverWait(driver, 10)
    agregar_btn = wait.until(EC.presence_of_element_located((By.XPATH, agregar_btn_xpath)))
    agregar_btn.click()
    
    time.sleep(tiempo_modulos)
    
    # Nombre de Rol
    
    campo_n_rol = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//INPUT[@id='title']"))
        )
    campo_n_rol.click()
    campo_n_rol.send_keys("Nombre de Rol de Prueba")

    # mi_perfil_acceder
    
    campo_n1 = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//TD[@class=' select-checkbox'])[2]"))
        )
    campo_n1.click()
    
    #mi_perfil_mis_datos_acceder
    
    campo_n2 = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//TD[@class=' select-checkbox'])[3]"))
        )
    campo_n2.click()
    
    # mi_perfil_mis_datos_ver_perfil_de_puesto
    
    campo_n3 = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//TD[@class=' select-checkbox'])[5]"))
        )
    campo_n3.click()
   
    # Seleccionar opcion 3 de carrusel
    
    campo_n4 = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//A[@href='#'][text()='3']"))
        )
    campo_n4.click()
    
    # mi_perfil_mis_datos_ver_mis_competencias
    
    campo_n5 = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//TD[@class=' select-checkbox'])[1]"))
        )
    campo_n5.click()
    
    # mi_perfil_mi_calendario_acceder
    
    campo_n6 = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//TD[@class=' select-checkbox'])[3]"))
        )
    campo_n6.click()
    
    # Guardar Repositorio
    print("Dando clic al botón Guardar...")
    guardar = WebDriverWait(driver, 20).until(
        EC.element_to_be_clickable((By.XPATH, guardar_xpath))
    )
    guardar.click()
    
    
    """
    
    ############################## ENTRANDO DE NUEVO AL SUBMODULO PARA COMPROBAR CAMBIOS
    
    # Entrando de nuevo a Menu Hamburguesa
    print("URL actual:", driver.current_url)
    print("Entrando de nuevo a Menu Hamburguesa...")
    element = driver.find_element(By.XPATH, menu_hamburguesa)
    driver.execute_script("arguments[0].scrollIntoView(true);", element)
    WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, menu_hamburguesa)))
    print("Dando clic ende nuevo a Menu Hamburguesa...")
    element.click()
    
    time.sleep(tiempo_modulos)
    
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
    
    """