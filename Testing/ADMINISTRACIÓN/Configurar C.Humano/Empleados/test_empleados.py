import time
import pytest
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException

#Variables
element_confirgurar_organizacion = "(//A[@href='#'])[3]"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/empleados'][text()='Empleados']"
agregar_btn_xpath= "//A[@href='https://192.168.9.78/admin/empleados/create'][text()='Registrar Empleados']"
campo_buscar_xpath= "(//INPUT[@type='search'])[2]"
btn2_editar = "(//I[@class='fas fa-edit'])[1]"
trespuntos_btn_xpath= "(//BUTTON[@class='btn btn-action-show-datatables-global d-none'])[1]"
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
guardar_xpath = "//BUTTON[@id='btnGuardar']"
guardar_act_xpath = "//BUTTON[contains(@class, 'btn') and contains(@class, 'btn-danger') and normalize-space()='Guardar']"


#Temporizadores
tiempo_modulos = 6
tiempo_carga = 10
tiempo_espera = 2.5

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
      
    # Entrando a Modulo Configurar Capital Humano
    print("Entrando a Capital Humano...")
    element = driver.find_element(By.XPATH, element_confirgurar_organizacion)
    driver.execute_script("arguments[0].scrollIntoView(true);", element)
    WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, element_confirgurar_organizacion)))
    print("Dando clic en Capital Humano...")
    element.click()
    
    time.sleep(tiempo_modulos)

    # Entrando a Sub Modulo Empleados
    print("Entrando a Sub Modulo Empleados...")
    entrar = driver.find_element(By.XPATH,element_entrar_submodulo)
    driver.execute_script("arguments[0].scrollIntoView(true);", element)
    WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH,element_entrar_submodulo)))
    print("Dando clic en Sub Modulo Empleados...")
    entrar.click()
    
    time.sleep(tiempo_modulos)
    
    print("URL actual:", driver.current_url)

def test_in_modulos(browser):
    
    in_modulos(browser)
    
##################################################### AGREGAR Y LLENAR REPOSITORIO ######################################

def add_empleados(driver):

    time.sleep(tiempo_modulos)
    
    # Dando clic en Boton Registrar Empleados
    print("Dando clic al botón resgistrar empleados...")
    wait = WebDriverWait(driver, 10)
    agregar_btn = wait.until(EC.presence_of_element_located((By.XPATH, agregar_btn_xpath)))
    agregar_btn.click()
    
    time.sleep(tiempo_modulos)

    # Nombre
    
    campo_nombre = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//INPUT[@id='name']"))
        )
    campo_nombre.click()
    campo_nombre.send_keys("Nombre de Prueba 00117")
    print("Llenando Campo Nombre ...")

    time.sleep(tiempo_modulos)

    # Area
    
    campo_area = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//SPAN[@class='select2-selection select2-selection--single'])[1]"))
    )
    campo_area.click()
    time.sleep(tiempo_espera)
    campo_area.send_keys("Arquitectura")
    time.sleep(tiempo_espera)
    campo_area.click()
    print("Llenando Campo Area ...")

    time.sleep(tiempo_modulos)
    
    # Puesto
    
    campo_puesto = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//SPAN[@class='select2-selection select2-selection--single'])[2]"))
    )
    campo_puesto.click()
    time.sleep(tiempo_espera)
    campo_puesto.send_keys("Operativo")
    time.sleep(tiempo_espera)
    campo_puesto.click()
    print("Llenando Campo Puesto ...")
    time.sleep(tiempo_modulos)
    
    # Jefe Inmediato
    
    campo_jefe_in = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//SPAN[@class='select2-selection select2-selection--single'])[3]"))
        )
    campo_jefe_in.click()
    time.sleep(tiempo_espera)
    campo_jefe_in.send_keys("Jorge Luis Chávez Sánches")
    time.sleep(tiempo_espera)
    campo_jefe_in.click()
    print("Llenando Campo Jefe Inmediato ...")

    time.sleep(tiempo_modulos)
    
    # Nivel Jerarquico
    
    campo_nivel_jer = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//SPAN[@class='select2-selection select2-selection--single'])[4]"))
        )
    campo_nivel_jer.click()
    time.sleep(tiempo_espera)
    campo_nivel_jer.send_keys("Director")
    time.sleep(tiempo_espera)
    campo_nivel_jer.click()
    print("Llenando Campo Nivel Jerarquico ...")

    time.sleep(tiempo_modulos)
    
    # Sexo
    
    campo_sexo = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//SPAN[@class='select2-selection select2-selection--single'])[5]"))
    )
    campo_sexo.click()
    time.sleep(tiempo_espera)
    campo_sexo.send_keys("Hombre")
    time.sleep(tiempo_espera)
    campo_sexo.click()
    print("Llenando Campo Sexo ...")

    time.sleep(tiempo_modulos)
    
    # Correo electronico
    
    campo_correoelectronico = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//INPUT[@id='email']"))
        )
    campo_correoelectronico.click()
    campo_correoelectronico.send_keys("correo@prueba.com")
    print("Llenando Campo Correo Electronico ...")

    time.sleep(tiempo_modulos)
    
    # Sede
    
    campo_sede = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//SPAN[@class='select2-selection select2-selection--single'])[6]"))
    )
    campo_sede.click()
    campo_sede.send_keys("Torre Murano")
    campo_sede.click()
    print("Llenando Campo Sede ...")

    time.sleep(tiempo_modulos)
    
    # Fecha de Ingreso
    
    campo_fecha_ingreso = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//input[contains(@name,'antiguedad')]"))
    )
    campo_fecha_ingreso.click()
    time.sleep(tiempo_espera)
    campo_fecha_ingreso.send_keys("02/02/2024")
    time.sleep(tiempo_espera)
    campo_fecha_ingreso.click()
    print("Llenando Campo Fecha de Ingreso ...")

    time.sleep(tiempo_modulos)

    # Guardar
    print("Dando clic al botón guardar ...")
    guardar = WebDriverWait(driver, 20).until(
        EC.element_to_be_clickable((By.XPATH, guardar_xpath))
    )
    guardar.click()

    time.sleep(tiempo_modulos)
    
    print("URL actual:", driver.current_url)
    
def test_add_empleados(browser):
    
    add_empleados(browser)
    
#################################BUSCAR REPOSITORIO Y ENTRAR A BOTONES DE EDICION###################################

def update_empleados(driver):

    time.sleep(tiempo_espera)

    # Campo Buscar
    campo_entrada = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, campo_buscar_xpath))
    )
    campo_entrada.clear()
    campo_entrada.send_keys("Nombre de Prueba 00117")
    print("Buscando empleado creado...")

    time.sleep(tiempo_carga)
    
    print("URL actual:", driver.current_url)
    
def test_update_empleados(browser):
    
    update_empleados(browser)
    
##################################################CONFIGURAR VISTA DATOS##############################################

def configurar_vista_datos(driver):

    time.sleep(tiempo_espera)

    # Numero de empleados
    campo_n_empleados = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//SPAN[@class='c-switch-slider'])[1])"))
    )
    campo_n_empleados.click()
    print("Buscando click campo Numero de empleados ...")
    
    time.sleep(tiempo_espera)
    
    # Fecha de Ingreso
    campo_fecha_ingreso = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//SPAN[@class='c-switch-slider'])[6]"))
    )
    campo_fecha_ingreso.click()
    print("Buscando click campo Fecha de Ingreso ...")
    
    time.sleep(tiempo_espera)
    
    # Genero
    campo_genero = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//SPAN[@class='c-switch-slider'])[7]"))
    )
    campo_genero.click()
    print("Buscando click campo Genero ...")
    
    time.sleep(tiempo_espera)
    
    # Puesto
    campo_puesto = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//SPAN[@class='c-switch-slider'])[4]"))
    )
    campo_puesto.click()
    print("Buscando click campo Puesto ...")
    
    time.sleep(tiempo_espera)
    
    print("Regresando a pantalla de inicio del modulo")
    driver.back()
    
    print("URL actual:", driver.current_url)
    
def test_configurar_vista_datos(browser):
    
    configurar_vista_datos(browser)
    
    
    
    
    
    

    
    
