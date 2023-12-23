from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
import time

tiempo_modulos = 4
tiempo_carga = 10
tiempo_espera = 2.5
sistema_gestion_xpath = "//a[@class='c-sidebar-nav-link active c-active'][contains(.,'Sistema de Gestión')]"
evaluacion_xpath= "//a[@class='nav-link active'][contains(.,'Evaluación')]"
informe_auditoria_xpath="//a[contains(.,'Informe de Auditoría')]"
crear_auditoria_btn_xpath="//a[@class='btn btn-info'][contains(.,'Crear auditoría +')]"
identificador_xpath="//input[contains(@name,'id_auditoria')]"
nombre_auditoria_xpath="//input[contains(@name,'nombre_auditoria')]"
objetivo_xpath="//div[contains(@class,'cke cke_reset_all cke_3 cke_panel cke_panel cke_menu_panel cke_ltr')]"
alcance_xpath="//div[contains(@class,'cke cke_reset_all cke_3 cke_panel cke_panel cke_menu_panel cke_ltr')]"
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


    #Sistema de Gestión
print("Entrando a Sistema de Gestión..")
element = driver.find_element(By.XPATH, sistema_gestion_xpath)
driver.execute_script("arguments[0].scrollIntoView(true);", element)
WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, sistema_gestion_xpath)))
print("Dando clic en Sistema de Gestión...")
element.click()

#Informe de Auditoria
print("El usuario se encuentra en la sección de Evaluación")
informa= driver.find_element(By.XPATH, informe_auditoria_xpath)
WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, informe_auditoria_xpath)))
print("Dando clic en Informe de Auditoria...")
informa.click()

#Crear Auditoria
print("El usuario se encuentra en la sección de Informe de Auditoria")
crear_auditoria_btn= driver.find_element(By.XPATH, crear_auditoria_btn_xpath)
WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, crear_auditoria_btn_xpath)))
print("Dando clic en Crear Auditoria...")
crear_auditoria_btn.click()

def ingresar_id(driver):
    # Obtener la entrada del usuario desde la terminal
    id_ingresado = input("Ingresa un número: ")

    # Encontrar el campo de entrada
    campo_entrada = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, identificador_xpath))
    )

    # Limpiar el campo de entrada y escribir el número ingresado por el usuario
    campo_entrada.clear()
    campo_entrada.send_keys(id_ingresado)

#Llamando a la función ID
ingresar_id(driver)


def ingresar_nombre ():
    # Obtener la entrada del usuario desde la terminal
    nombre_ingresado = input("Ingresa un nombre: ")

    # Encontrar el campo de entrada
    campo_entrada = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, nombre_auditoria_xpath))
    )

    # Limpiar el campo de entrada y escribir el número ingresado por el usuario
    campo_entrada.clear()
    campo_entrada.send_keys(nombre_ingresado)

#Llamando a la función Nombre
ingresar_nombre()

def objetivo ():
    # Obtener la entrada del usuario desde la terminal
    objetivo_ingresado = input("Ingresa un objetivo: ")

    # Encontrar el campo de entrada
    campo_entrada = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, objetivo_xpath))
    )

    # Limpiar el campo de entrada y escribir el número ingresado por el usuario
    campo_entrada.clear()
    campo_entrada.send_keys(objetivo_ingresado)

#Llamando a la función Objetivo
objetivo()

def alcance ():
    # Obtener la entrada del usuario desde la terminal
    alcance_ingresado = input("Ingresa un alcance: ")

    # Encontrar el campo de entrada
    campo_entrada = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, alcance_xpath))
    )

    # Limpiar el campo de entrada y escribir el número ingresado por el usuario
    campo_entrada.clear()
    campo_entrada.send_keys(alcance_ingresado)

#Llamando a la función Alcance
alcance()

