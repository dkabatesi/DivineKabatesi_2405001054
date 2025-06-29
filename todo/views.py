from django.shortcuts import render, redirect
from .models import Task

@login_required
def home(request):
    if request.method == 'POST':
        title = request.POST.get('title')
        due_date = request.POST.get('due_date') or None
        if title:
            Task.objects.create(title=title, due_date=due_date, user=request.user)
        return redirect('home')

    tasks = Task.objects.filter(user=request.user).order_by('completed', 'due_date')
    return render(request, 'todo/home.html', {'tasks': tasks})


def delete_task(request, task_id):
    Task.objects.get(id=task_id).delete()
    return redirect('home')

def complete_task(request, task_id):
    task = Task.objects.get(id=task_id)
    task.completed = True
    task.save()
    return redirect('home')

from django.contrib.auth import login, logout, authenticate
from django.contrib.auth.forms import UserCreationForm, AuthenticationForm
from django.contrib.auth.decorators import login_required

def register_user(request):
    if request.method == 'POST':
        form = UserCreationForm(request.POST)
        if form.is_valid():
            user = form.save()
            login(request, user)
            return redirect('home')
    else:
        form = UserCreationForm()
    return render(request, 'todo/register.html', {'form': form})

def login_user(request):
    if request.method == 'POST':
        form = AuthenticationForm(data=request.POST)
        if form.is_valid():
            login(request, form.get_user())
            return redirect('home')
    else:
        form = AuthenticationForm()
    return render(request, 'todo/login.html', {'form': form})

def logout_user(request):
    logout(request)
    return redirect('login')

# Create your views here.