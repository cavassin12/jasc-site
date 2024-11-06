create table public.usuarios(
	codigo serial not null primary key,
	nome character varying not null,
	email character varying not null unique,
	senha character varying not null,
	status bit not null default '1'
);
insert into public.usuarios(nome, email, senha)values('sistema', 'sistema', 'ma==');


create table public.modalidades(
	codigo serial not null primary key,
	descricao character varying(50) not null,
	icone character varying
);

drop table public.banners;
create table public.banners(
	codigo serial not null primary key,
	descricao character varying(50),
	caminho_banner character varying,
	status bit not null default '0'
);

create table public.noticias(
	codigo serial not null primary key,
	titulo character varying,
	texto text,
	dt_recortd timestamp default now(),
	usuario int not null references public.usuarios(codigo),
	status bit not null default '0'
);

create table public.noticias_images(
	codigo serial not null primary key,
	noticia_codigo int not null references public.noticias(codigo),
	imagem character varying,
	status bit not null default '1'
);




create table public.cidades(
	codigo int not null primary key,
	descricao character varying
);

drop table public.jogos;
create table public.jogos(
	codigo bigserial not null primary key,
	modalidade_codigo int not null references public.modalidades(codigo),
	data date not null,
	hora time,
	local character varying,
	cidade_a_codigo int not null references public.cidades(codigo),
	cidade_b_codigo int not null references public.cidades(codigo),
	cidade_vencedor_codigo int references public.cidades(codigo),
	pontos_a numeric(6,2) not null default 0.00,
	pontos_b numeric(6,2) not null default 0.00,
	link_transmissao character varying,
	destaque bit not null default '0',
	status bit not null default '0'
);


create table public.galerias(
	codigo serial not null primary key,
	data date not null,
	descricao character varying(120),
	status bit not null default '0'
);

create table public.galerias_imagens(
	codigo bigserial not null primary key,
	link_img character varying
);



