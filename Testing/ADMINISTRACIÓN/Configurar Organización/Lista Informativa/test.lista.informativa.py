from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
import time

#GRUPO DE AREAS


#Variables
element_confirgurar_organizacion = "(//I[@class='material-symbols-outlined i-direct'][text()='keyboard_arrow_down'])[2]"
element_crear_lista_informativa = "//A[@href='https://192.168.9.78/admin/lista-informativa'][text()='Lista Informativa']"
clasificacion_xpath="//a[contains(.,'Clasificación')]"
agregar_btn_xpath= "//BUTTON[@class='btn btn-xs btn-outline-success rounded ml-2 pr-3']"
id_xpath="///input[contains(@type,'number')]"
save_btn_xpath="//button[@class='btn btn-danger'][contains(.,'Guardar')]"
opciones_xpath="(//i[contains(@class,'fa-solid fa-ellipsis-vertical')])[1]"
guardar_xpath="(//a[contains(.,'Editar')])[1]"


#Temporizadores
tiempo_modulos = 4
tiempo_carga = 10
tiempo_espera = 2.5

# Pide al usuario que ingrese sus credenciales
usuario = input("Ingresa tu nombre de usuario: ")
contrasena = input("Ingresa tu contraseña: ")

# Crear una instancia del controlador de Firefox
driver = webdriver.Firefox()

try:
    # Abrir la URL
    driver.get('https://192.168.9.78/')

    # Maximizar la ventana del navegador
    driver.maximize_window()
    time.sleep(5)

    # Ingresar credenciales
    usr = driver.find_element(By.XPATH, "//input[contains(@name,'email')]").send_keys(usuario)
    time.sleep(tiempo_modulos)
    pw = driver.find_element(By.XPATH, "//input[contains(@name,'password')]").send_keys(contrasena)
    time.sleep(tiempo_modulos)

    # Hacer clic en el botón de envío
    btn = driver.find_element(By.XPATH, "//button[@type='submit'][contains(.,'Enviar')]")
    btn.click()

    # Esperar hasta 10 segundos para encontrar un elemento que indique un inicio de sesión exitoso
    element = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//font[@class='letra_blanca'][contains(.,'Mi perfil')]"))
    )
    print("Inicio de sesión exitoso")
except TimeoutException:
    print("Inicio de sesión fallido")

time.sleep(tiempo_modulos)

#Entrando a menu hamburguesa
menu_hambuerguesa=driver.find_element(By.XPATH,"//BUTTON[@class='btn-menu-header']")
menu_hambuerguesa.click()
time.sleep(tiempo_modulos)

time.sleep(tiempo_modulos)

#Modulo Configurar Organizacion
print("Entrando a Configurar Organizacion...")
element = driver.find_element(By.XPATH, element_confirgurar_organizacion)
driver.execute_script("arguments[0].scrollIntoView(true);", element)
WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, element_confirgurar_organizacion)))
print("Dando clic en Configurar Organizacion...")
element.click()

time.sleep(tiempo_modulos)

#Sub Lista Informativa
print("Entrando a Sub modulo Crear Areas...")
element = driver.find_element(By.XPATH, element_crear_lista_informativa)
driver.execute_script("arguments[0].scrollIntoView(true);", element)
WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, element_crear_lista_informativa)))
print("Dando clic en Sub modulo Crear Areas...")
element.click()

time.sleep(tiempo_modulos)


#Agregar Lista Informativa
print("Dando clic al botón Agregar...")
wait = WebDriverWait(driver, 10)
# Esperar a que el elemento esté presente en el DOM
agregar_btn = wait.until(EC.presence_of_element_located((By.XPATH, agregar_btn_xpath)))
# Ahora intenta hacer clic en el elemento
agregar_btn.click()

time.sleep(tiempo_modulos)

#Nombre del Lista Informativa
def ingresar_area(driver):
    # Obtener la entrada del usuario desde la terminal
    n_area_ingresado = input("Ingrese Nombre del Area a Agregar: ")

    # Encontrar el campo de entrada
    campo_entrada = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//INPUT[@id='area']"))
    )

    # Limpiar el campo de entrada y escribir el número ingresado por el usuario
    campo_entrada.clear()
    campo_entrada.send_keys(n_area_ingresado)

#Llamando a la función Nombre del Area
ingresar_area(driver)

time.sleep(tiempo_modulos)

#Responsable
def ingresar_responsable(driver):
    # Obtener la entrada del usuario desde la terminal
    responsable_ingresado = input("Ingrese Responsable: ")

    # Encontrar el campo de entrada
    campo_entrada = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//SELECT[@id='nombre_contacto_puesto']"))
    )

    # Limpiar el campo de entrada y escribir el dato ingresado por el usuario
    campo_entrada.click()
    time.sleep(tiempo_espera)
    campo_entrada.send_keys(responsable_ingresado)
    time.sleep(tiempo_espera)
    campo_entrada.click()

#Llamando a la función Descripcion
ingresar_responsable(driver)

time.sleep(tiempo_modulos)

"""
#Nombre del Puesto 
def ingresar_puesto(driver):
    # Obtener la entrada del usuario desde la terminal
    puesto_ingresado = input("Ingrese Nombre del Puesto a Agregar: ")

    # Encontrar el campo de entrada
    campo_entrada = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//DIV[@id='contacto_puesto']"))
    )

    # Limpiar el campo de entrada y escribir el número ingresado por el usuario
    campo_entrada.clear()
    campo_entrada.send_keys(puesto_ingresado)

#Llamando a la función Nombre del Puesto
ingresar_puesto(driver)

"""

#Area a la que Reporta
def ingresar_area_a_la_que_reporta(driver):
    # Obtener la entrada del usuario desde la terminal
    area_reporta_ingresado = input("Ingrese Area a la que Reporta: ")

    # Encontrar el campo de entrada
    campo_entrada = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//SELECT[@id='inputGroupSelect01']"))
    )

    # Limpiar el campo de entrada y escribir el dato ingresado por el usuario
    campo_entrada.click()
    time.sleep(tiempo_espera)
    campo_entrada.send_keys(area_reporta_ingresado)
    time.sleep(tiempo_espera)
    campo_entrada.click()

#Llamando a la función Area a la que Reporta
ingresar_area_a_la_que_reporta(driver)

time.sleep(tiempo_modulos)

#Grupo 
def ingresar_grupo(driver):
    # Obtener la entrada del usuario desde la terminal
    grupo_ingresado = input("Ingrese Grupo: ")

    # Encontrar el campo de entrada
    campo_entrada = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//SELECT[@id='id_grupo']"))
    )

    # Limpiar el campo de entrada y escribir el dato ingresado por el usuario
    campo_entrada.click()
    time.sleep(tiempo_espera)
    campo_entrada.send_keys(grupo_ingresado)
    time.sleep(tiempo_espera)
    campo_entrada.click()

#Llamando a la función Grupo
ingresar_grupo(driver)

time.sleep(tiempo_modulos)

#Descripcion
def ingresar_descripcion(driver):
    # Obtener la entrada del usuario desde la terminal
    descripcion_ingresado = input("Ingrese Descripcion: ")

    # Encontrar el campo de entrada
    campo_entrada = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//TEXTAREA[@id='descripcion']"))
    )

    # Limpiar el campo de entrada y escribir el número ingresado por el usuario
    campo_entrada.clear()
    campo_entrada.send_keys(descripcion_ingresado)

#Llamando a la función Nombre del Puesto
ingresar_descripcion(driver)

time.sleep(tiempo_espera)

#Guardar
print("Dando clic al botón Guardar...")
def realizar_accion_guardar(driver):
    # Opciones
    guardar_xpath = "//BUTTON[contains(@class, 'btn') and contains(@class, 'btn-danger') and normalize-space()='Guardar']"
    guardar = WebDriverWait(driver, 20).until(
        EC.element_to_be_clickable((By.XPATH, guardar_xpath))
    )
    guardar.click()

# Llamada a la función Guardar
realizar_accion_guardar(driver)