import time
import pytest
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException

#Variables
element_entrar_modulo = "//A[@href='https://192.168.9.78/admin/capital-humano']"
element_entrar_submodulo = "//a[contains(.,'Evaluación 360')]"
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
tiempo_carga = 10
tiempo_espera = 3
tiempo_llenado = 2
tiempo_diez = 10

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
    
    time.sleep(tiempo_espera)

    # Entrando a Sub Modulo Evalución 360
    print("Entrando a Sub Modulo Evalución 360...")
    entrar = driver.find_element(By.XPATH, element_entrar_submodulo)
    WebDriverWait(driver, 10).until(EC.element_to_be_clickable((By.XPATH, element_entrar_submodulo)))
    print("Dando clic en Sub Modulo Evalución 360...")
    entrar.click()
    
    time.sleep(tiempo_espera)
    
    # Entrando a Crear Evaluaciones
    print("Entrando a Crear Evaluaciones...")
    entrar = driver.find_element(By.XPATH,element_crear_evaluacion)
    WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH,element_crear_evaluacion)))
    print("Dando clic en Crear Evaluaciones...")
    entrar.click()
    
    time.sleep(tiempo_espera)
    
    print("URL actual:", driver.current_url)
    
def test_in_modulos(browser):
    
    in_modulos(browser)

    
##################################################### AGREGAR Y LLENAR REPOSITORIO ######################################

################################################# Repositorio Configuracion

def create_configuracion(driver):
    
    time.sleep(tiempo_diez)
    
    # Llenando campo Nombre
    
    campo_nombre = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//INPUT[@id='nombre']"))
        )
    print("Dando click en campo nombre")
    campo_nombre.click()
    time.sleep(tiempo_llenado)
    print("Llenando campo nombre")
    campo_nombre.send_keys("Cesar Ernesto Escobar Hernandez")
    
    time.sleep(tiempo_espera)
    
    # Descripcion
    
    campo_descripcion = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//TEXTAREA[@class='form-control ']"))
        )
    print("Dando click en campo descripcion")
    campo_descripcion.click()
    time.sleep(tiempo_llenado)
    print("Llenando campo descripcion")
    campo_descripcion.clear()
    campo_descripcion.send_keys("Prueba de descripcion para pruebas modulos evaluaciones360")
    
    time.sleep(tiempo_espera)
    
    # Boton Competencias
    
    btn_competencias = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//SPAN[@class='checkmark'])[1]"))
        )
    print("Dando click en boton competencias")
    btn_competencias.click()
    
    time.sleep(tiempo_espera)
    
    # Boton Siguiente
    
    btn_siguiente = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//BUTTON[@type='button']"))
        )
    print("Dando click en siguiente")
    btn_siguiente.click()
    
    time.sleep(tiempo_espera)
    
    print("URL actual:", driver.current_url)
      
def test_create_configuracion(browser):
    
    create_configuracion(browser)
    
################################################# Repositorio Publico Objetivo

def create_publico_objetivo(driver):
    
    time.sleep(tiempo_diez)
    
    # Publico Objetivo
    
    campo_objetivo = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//SELECT[@id='evaluados_objetivo']"))
        )
    print("Dando click en campo objetivo")
    campo_objetivo.click()
    time.sleep(tiempo_llenado)
    print("Llenando campo nombre")
    campo_objetivo.send_keys("Manualmente")
    print("Dando click en campo objetivo")
    time.sleep(tiempo_llenado)
    campo_objetivo.click()
    
    time.sleep(tiempo_espera)
    
     # Seleccionar empleados a evaluar
    
    campo_empleados_1 = WebDriverWait(driver, 10).until(
        EC.element_to_be_clickable((By.XPATH, "//UL[@class='select2-selection__rendered']"))
    )
    print("Dando click en campo selecciona empleados a evaluar")
    campo_empleados_1.click()
    time.sleep(tiempo_espera)
    print("Llenando campo selecciona empleados a evaluar")
    campo_empleados_1.send_keys("Cesar Ernesto Escobar Hernández")
    print("Esperando resultados de búsqueda")
    WebDriverWait(driver, 10).until(
        EC.visibility_of_element_located((By.XPATH, "//li[@role='treeitem'][contains(text(),'Cesar Ernesto Escobar Hernández')]"))
    )
    print("Seleccionando empleado")
  

    campo_empleados_2 = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//UL[@class='select2-selection__rendered']"))
        )
    print("Dando click en campo selecciona empleados a evaluar")
    campo_empleados_2.click()
    time.sleep(tiempo_espera)
    print("Llenando campo selecciona empleados a evaluar")
    campo_empleados_2.send_keys("Marti David Tendilla Gonzalez")
    print("Dando click en campo selecciona empleados a evaluar")
    time.sleep(tiempo_espera)
    campo_empleados_2.click()
    
    time.sleep(tiempo_espera)
    
    campo_empleados_3 = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//UL[@class='select2-selection__rendered']"))
        )
    print("Dando click en campo selecciona empleados a evaluar")
    campo_empleados_3.click()
    time.sleep(tiempo_espera)
    print("Llenando campo selecciona empleados a evaluar")
    campo_empleados_3.send_keys("Zaid Arath García Hernández")
    print("Dando click en campo selecciona empleados a evaluar")
    time.sleep(tiempo_espera)
    campo_empleados_3.click()
    
    time.sleep(tiempo_espera)
    
    # Boton Siguiente
    
    btn_siguiente = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//BUTTON[@type='button'])[5]"))
        )
    print("Dando click en siguiente")
    btn_siguiente.click()
    
    time.sleep(tiempo_espera)
    
    print("URL actual:", driver.current_url)
      
def test_publico_objetivo(browser):
    
    create_publico_objetivo(browser)
    
################################################# Repositorio Evaluadores

def create_evaluadores(driver):
    
    time.sleep(tiempo_diez)
    
    # Pares primera opcion
    
    pares_1 = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//SELECT[@name=''])[3]"))
        )
    print("Dando click en primer campo pares")
    pares_1.click()
    time.sleep(tiempo_llenado)
    print("Llenando campo pares")
    pares_1.send_keys("Cecilia Torres Bravo")
    print("Dando click en campo pares")
    time.sleep(tiempo_llenado)
    pares_1.click()
    
    time.sleep(tiempo_espera)
    
     # Pares segunda opcion
    
    pares_2 = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//SELECT[@name=''])[7]"))
        )
    print("Dando click en segundo campo pares")
    pares_2.click()
    time.sleep(tiempo_llenado)
    print("Llenando campo pares")
    pares_2.send_keys("Nelly Arriaga Dimas")
    print("Dando click en campo pares")
    time.sleep(tiempo_llenado)
    pares_2.click()
    
    time.sleep(tiempo_espera)
    
    # Boton Siguiente
    
    btn_siguiente = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//BUTTON[@type='button'])[2]"))
        )
    print("Dando click en siguiente")
    btn_siguiente.click()
    
    time.sleep(tiempo_espera)
    
    print("URL actual:", driver.current_url)
      
def test_create_evaluadores(browser):
    
    create_evaluadores(browser)


################################################# Repositorio Periodos

def create_periodos(driver):
    
    time.sleep(tiempo_diez)
    
    # Fecha evaluacion 1
    """
    fecha_inicio = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//INPUT[@class='form-control'])[1]"))
        )
    print("Dando click en campo fecha de inicio")
    fecha_inicio.click()
    time.sleep(tiempo_llenado)
    print("Llenando campo fecha de inicio")
    fecha_inicio.click()
    fecha_inicio.send_keys("04")
    print("Ingresando fecha inicio")
    time.sleep(tiempo_llenado)
    fecha_inicio.click()
    
    time.sleep(tiempo_espera)
    
    fecha_fin = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//INPUT[@class='form-control'])[2]"))
        )
    print("Dando click en campo fecha de fin")
    fecha_fin.click()
    time.sleep(tiempo_llenado)
    print("Llenando campo fecha de inicio")
    fecha_fin.click()
    fecha_fin.send_keys("15")
    print("Ingresando fecha fin")
    time.sleep(tiempo_llenado)
    fecha_fin.click()
    
    time.sleep(tiempo_espera) """
    
    # Boton Agregar Periodo
    
    btn_periodo = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//BUTTON[@id='addPeriodo']"))
        )
    print("Dando agregar perido")
    btn_periodo.click()
    
    time.sleep(tiempo_espera)
    
    # Fecha evaluacion 2
    """
    fecha_inicio = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//INPUT[@class='form-control'])[3]"))
        )
    print("Dando click en campo fecha de inicio")
    fecha_inicio.click()
    time.sleep(tiempo_llenado)
    print("Llenando campo fecha de inicio")
    fecha_inicio.click()
    fecha_inicio.clear()
    fecha_inicio.send_keys("16/03/2024")
    print("Ingresando fecha inicio")
    time.sleep(tiempo_llenado)
    fecha_inicio.click()
    
    time.sleep(tiempo_espera)
    
    fecha_fin = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//INPUT[@class='form-control'])[4]"))
        )
    print("Dando click en campo fecha de fin")
    fecha_fin.click()
    time.sleep(tiempo_llenado)
    print("Llenando campo fecha de inicio")
    fecha_fin.click()
    fecha_fin.clear()
    fecha_fin.send_keys("31/03/2024")
    print("Ingresando fecha fin")
    time.sleep(tiempo_llenado)
    fecha_fin.click()
    
    time.sleep(tiempo_espera)"""
    
    time.sleep(tiempo_carga)
    
    # Boton Activar
    
    btn_activar = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//BUTTON[@type='button'])[2]"))
        )
    print("Dando click en activar")
    btn_activar.click()
    
    time.sleep(tiempo_carga)
    
    # Boton Activar
    
    btn_activar = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//BUTTON[@type='button'])[2]"))
        )
    print("Dando click en activar")
    btn_activar.click()
    
    time.sleep(tiempo_carga)
    
    print("URL actual:", driver.current_url)
      
def test_create_periodos(browser):
    
    create_periodos(browser)
    
