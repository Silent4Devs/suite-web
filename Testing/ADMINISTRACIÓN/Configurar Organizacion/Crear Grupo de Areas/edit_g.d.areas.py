from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
import time

#TEST GRUPO DE AREAS


#Variables
element_confirgurar_organizacion = "(//I[@class='material-symbols-outlined i-direct'][text()='keyboard_arrow_down'])[2]"
element_g_d_areas = "//A[@href='https://192.168.9.78/admin/grupoarea'][text()='Crear Grupo de Áreas']"
clasificacion_xpath="//a[contains(.,'Clasificación')]"
editar_btn_xpath= "(//I[@class='fas fa-edit'])[2]"
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

#Sub modulo Grupo de Areas
print("Entrando a Sub modulo Grupo de Areas...")
element = driver.find_element(By.XPATH, element_g_d_areas)
driver.execute_script("arguments[0].scrollIntoView(true);", element)
WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, element_g_d_areas)))
print("Dando clic en Sub modulo Sedes...")
element.click()

time.sleep(tiempo_modulos)


#Editar Area
print("Dando clic al botón Editar...")
wait = WebDriverWait(driver, 10)
# Esperar a que el elemento esté presente en el DOM
editar_btn = wait.until(EC.presence_of_element_located((By.XPATH, editar_btn_xpath)))
# Ahora intenta hacer clic en el elemento
editar_btn.click()

time.sleep(tiempo_modulos)

#Nombre del Grupo
def ingresar_grupo(driver):
    # Obtener la entrada del usuario desde la terminal
    grupo_ingresado = input("Ingrese Actualizacion Nombre del Grupo: ")

    # Encontrar el campo de entrada
    campo_entrada = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//INPUT[@id='nombre']"))
    )

    # Limpiar el campo de entrada y escribir el número ingresado por el usuario
    campo_entrada.clear()
    campo_entrada.send_keys(grupo_ingresado)

#Llamando a la función Grupo
ingresar_grupo(driver)


#Descripcion
def ingresar_descripcion(driver):
    # Obtener la entrada del usuario desde la terminal
    descripcion_ingresado = input("Ingrese Actualizacion Descripcion: ")

    # Encontrar el campo de entrada
    campo_entrada = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//TEXTAREA[@id='descripcion']"))
    )

    # Limpiar el campo de entrada y escribir el número ingresado por el usuario
    campo_entrada.clear()
    campo_entrada.send_keys(descripcion_ingresado)

#Llamando a la función Descripcion
ingresar_descripcion(driver)

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
